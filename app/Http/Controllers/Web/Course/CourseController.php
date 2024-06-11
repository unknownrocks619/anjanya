<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lession;
use App\Models\Portal\MemberEmergencyMeta;
use App\Models\Portal\MemberInfo;
use App\Models\Portal\Program;
use App\Models\Portal\ProgramUser;
use App\Models\Portal\UserModel;
use App\Models\User;
use App\Models\UserCourseEnrollment;
use App\Models\UserWatchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    //

    public function profile_course_list($current_tab = 'enrolled_course')
    {
        $tabs = [
            'enrolled_course' => UserCourseEnrollment::getEnrolledCourse(),
            'active_course' => UserCourseEnrollment::getActiveEnrolledCourse(),
            'complete_course' => UserCourseEnrollment::where('user_id', auth()->guard('web')->id())->where('completed', true)->get(),
        ];
        return $this->user_theme('courses.profile', ['tabs' => $tabs, 'current_tab' => $current_tab]);
    }

    public function load($course_slug = null, string $options = null)
    {

        $default_courses = ['courses', 'all-courses', 'all-course'];

        if (!$course_slug || in_array($course_slug, $default_courses)) {

            $courses = Course::where('active', true)->orderBy('sort_by', 'asc')->get();
            return $this->user_theme('courses.list', ['courses' => $courses]);
        }

        $course = Course::where('slug', $course_slug)->where('active', true)->first();
        
        if (!$course) {
            abort(404);
        }

        if ($options && method_exists($this, $options)) {

            return $this->$options($course);
        }
        return $this->frontend_theme(
            'master-nav',
            'courses.detail',
            [
                'isLanding' => false,
                'isFooter'  => true,
                'course' => $course
            ]
        );
        return $this->user_theme('courses.detail', ['course' => $course]);
    }

    public function watch(Course $course, Lession $preview_lession = null)
    {
        $course->load(['getSeo', 'getImage', 'chapters']);

        if (!$preview_lession) {
            // get watch history lession or first lession.
            $lession = UserWatchHistory::where('course_id', $course->getKey())
                ->where('user_id', auth()->guard('web')->id())
                ->where('completed', false)
                ->with(['getLession'])
                ->orderBy('updated_at', 'desc')
                ->first();

            if (!$lession) {

                $first_chapter = $course->chapters()->where('active', true)->orderBy('sort_by', 'asc')->first();
                if ($first_chapter) {

                    $lession = Lession::where('chapter_id', $first_chapter->getKey())
                        ->where('course_id', $course->getKey())
                        ->orderBy('sort_by', 'asc')
                        ->first();
                }

                $this->markHistory(
                    auth()->guard('web')->user(),
                    $course,
                    $first_chapter,
                    $lession
                );
            } else {
                $lession = $lession->getLession;
            }
        } else {

            $lession = $preview_lession;
        }

        $lession->load(['getComponents', 'getChapter']);

        return $this->user_theme('courses.watch', ['course' => $course, 'lession' => $lession]);
    }

    public function enroll(Request $request,  string $course_slug, Course $course)
    {
        
        if ($request->post() )  {
            return $this->enrollUser($request);
        }


        return $this->frontend_theme(
            'master-nav',
            'courses.enroll',
            [
                'isLanding' => false,
                'isFooter'  => true,
                'course' => $course
            ]
        );

        return $this->user_theme('courses.enroll', ['course' => $course]);

        if (!auth()->guard('web')->check()) {
            session()->put('intended', route('frontend.courses.load', ['course_slug' => $course->slug]));
            return $this->json(false, 'Please Login First.', 'redirect', ['location' => route('frontend.users.login')]);
        }

        if (UserCourseEnrollment::where('user_id', auth()->guard('web')->id())->where('course_id', $course->getKey())->exists()) {
            return $this->json(true, 'Please wait..', 'redirect', ['location' => '/course/' . $course->slug . '/watch']);
        }

        $user_enroll = new UserCourseEnrollment;
        $user_enroll->fill([
            'course_id' => $course->getKey(),
            'active'    => true,
            'user_id'   => auth()->guard('web')->id()
        ]);
        try {
            //code...
            $user_enroll->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Error ! Unable to enroll', '', ['error' => $th->getMessage()]);
        }
        return $this->json(true, 'Please wait..', 'redirect', ['location' => '/course/' . $course->slug . '/watch']);
    }

    public function complete(Request $request, Lession $lession, Chapter $chapter, Course $course = null)
    {
        if (!$course) {
            $course = Course::find($chapter->course_id);
        }
        // mark history complete.
        $streamHistory = UserWatchHistory::where('lession_id', $lession->getKey())
            ->where('chapter_id', $chapter->getKey())
            ->where('user_id', auth()->guard('web')->id())
            ->first();

        $streamHistory->completed = true;


        try {
            $streamHistory->save();
        } catch (\Throwable $th) {
            //throw $th;
        }
        // create new history and send it to user.
        $nextLession = Lession::where('chapter_id', $chapter->getKey())
            ->where('sort_by', '>', $lession->sort_by)
            ->first();
        if (!$nextLession) {
            // get next chapter and first lession.
            $nextChapter = Chapter::where('sort_by', '>', $chapter->sort_by)
                ->where('course_id', $chapter->course_id)
                ->first();
            if (!$nextChapter) {
                // user has gone through all chapters.
                $userEnroll = UserCourseEnrollment::where('course_id', $chapter->course_id)
                    ->where('user_id', auth()->guard('web')->id())
                    ->first();
                $userEnroll->completed = true;
                $userEnroll->active = false;
                $userEnroll->save();
                return $this->json(true); // do nothing.
            }
            $chapter = $nextChapter;
            $lession = $chapter->lessions()->orderBy('sort_by', 'asc')->first();
        } else {
            $lession  = $nextLession;
        }
        $this->markHistory(auth()->guard('web')->user(), $course, $chapter, $nextLession);
        return $this->json(true, '', 'redirect', ['location' => route('frontend.courses.course_switch', ['course_slug' => $course->slug, 'lession' => $lession, 'chapter' => $chapter, 'course' => $course])]);
        // render javascript
    }

    public function markHistory(User $user, Course $course, Chapter $chapter, Lession $lession = null)
    {

        if (!$lession) {
            $lession = $chapter->lessions()->first();
        }
        if (!$lession) {
            return;
        }
        $userHistory = UserWatchHistory::where('user_id', $user->getkey())
            ->where('course_id', $chapter->getKey())
            ->where('chapter_id', $chapter->getKey())
            ->where('lession_id', $lession->getKey())
            ->first();
        if (!$userHistory) {
            $userHistory = new UserWatchHistory;
            $userHistory->fill([
                'course_id' => $chapter->course_id,
                'chapter_id' => $chapter->getKey(),
                'lession_id'    => $lession->getKey(),
                'user_id'       => $user->getKey()
            ]);
        } else {
            $userHistory->updated_at = now();
        }
        $userHistory->save();
    }

    public function navi(string $course_slug, Lession $lession, Chapter $chapter, Course $course = null)
    {
        if (!$course) {
            $course = Course::find($chapter->course_id);
        }
        $this->markHistory(auth()->guard('web')->user(),  $course, $chapter, $lession);

        return $this->watch($course, $lession);
    }

    public function enrollUser(Request $request) {
        $request->validate([
            'first_name'    => 'required|string',
            'middle_name'   => 'nullable|string',
            'last_name'     => 'required|string',
            'gender'        => 'required|in:male,female,other',
            'country'       => 'required',
            'state'          => 'required|string',
            'street_address'    => 'required|string',
            'date_of_birth'  => 'required|date|date_format:Y-m-d',
            'email'         => 'required|email',
            'password'      => 'required|string',
            'phone_number'  => 'required',
            'emergency_contact_person'  => 'required',
            'emergency_contact_person_relation' => 'required',
            'emergency_phone'   => 'required',
            'profession'    => 'required'
        ]);

        $unicodeCharacter = $this->check_unicode_character($request->all());
        if ( $unicodeCharacter ) {
            return $this->generateValidationError($unicodeCharacter,'Invalid Characters.');
            return $this->json(false,'Error: we do not support unicdoe character. Please remove all unicode character.',null,$unicodeCharacter);
        }

        // check if email already exists.
        $userExists = UserModel::where('email', $request->post('email'))->first();

        if ( $userExists ) {
            return $this->generateValidationError('email','User already exists.');
        }

        $user = new UserModel();
        $user->fill([
            "first_name" => $request->post('first_name'),
            "middle_name" => $request->post('middle_name'),
            "last_name" => $request->post('last_name'),
            "country"   => $request->post('country'),
            'city'  => $request->post('state'),
            'address'   => ['street_address' => $request->post('street_address')],
            'date_of_birth' => $request->post('date_of_birth'),
            'email' => $request->post('email'),
            'sharing_code' => time(),
            'phone_number' => $request->post('phone_number'),
            'gender'    => $request->post('gender'),
            'password'  => Hash::make($request->post('password')),
        ]);

        $full_name = $request->post('first_name');

        if (trim($request->post('middle_name')) ) {
            $full_name .= " " . $request->post('middle_name');
        }

        $full_name .= " ". $request->post('last_name');
        $user->role_id = 7;
        $user->full_name = trim($full_name);
        $uuid = explode('-',Str::uuid());
        $user->member_uuid = $uuid[count($uuid)-1];

        /**
         * Now update emergency contact information.
         */

        $emergency = new MemberEmergencyMeta();
        $emergency->member_id = $user->getKey();
        $emergency->contact_person = $request->post('emergency_contact_person');
        $emergency->relation = $request->post('emergency_contact_person_relation');
        $emergency->phone_number = $request->post('emergency_phone');
        $emergency->contact_type = 'emergency';

         /**
          * Refer person.
          */
        $userInfo = new MemberInfo;
        $personal = [
            "date_of_birth" => $request->post('date_of_birth'),
            "place_of_birth" => $request->post('place_of_birth'),
            "street_address" => $request->post('street_address'),
            "state" => $request->post('state'),
            "gender" => $request->post('gender')
        ];

        $education = [
            "education" => $request->post('education'),
            "education_major" => $request->post('field_of_study'),
            "profession" => $request->post('profession')
        ];

        if ($request->referer_person) {
            $remarks = [
                "referer_person" => $request->post('referer_person'),
                "referer_relation" => $request->post('referer_relation'),
                "referer_contact" => $request->post('referer_contact')
            ];
            $userInfo->remarks = $remarks;
        }
        $userInfo->education = $education;
        $userInfo->personal = $personal;

        $vedantaProgram = Program::with(["active_batch", "active_fees", "active_sections"])->where('status', "active")->where('id', 2)->first();

        if (!$vedantaProgram || !$vedantaProgram->active_batch  || !$vedantaProgram->active_sections) {
            return $this->json(false,'Unable to enroll at the moment. Please try again later');
        }
        try {
            DB::transaction(function () use ($vedantaProgram, $user, $userInfo, $emergency) {
                $user->save();

                $emergency->member_id = $user->getKey();
                $emergency->save();

                $userInfo->member_id = $user->getKey();
                $userInfo->save();

                if (ProgramUser::where('student_id', $user->getKey())->where('program_id', $vedantaProgram->getKey())->exists()) {
                    return $this->json(true,'Account already available in section.','redirect',['location' => '']);
                }

                $programUser = new ProgramUser();
                $programUser->fill([
                    'program_id' => $vedantaProgram->getKey(),
                    'student_id'    => $user->getKey(),
                    'batch_id'  => $vedantaProgram->active_batch->id,
                    'program_section_id' => $vedantaProgram->active_sections->id,
                    'active'    => true
                ]);
        
                $programUser->save();

            });
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return $this->json(false,'Failed to create new account. Please try again.');
        }
        
        return $this->json(true,'Registration Complete','redirect',['location' => route('frontend.courses.enroll.enroll.complete',[ 'course_slug' => 'vedanta-darshan','course' => 1])]);
        
        
    }

    public function enrollComplete(string $course_slug, Course $course) {
        return $this->frontend_theme(
            'master-nav',
            'courses.enroll-complete',
            [
                'isLanding' => false,
                'isFooter'  => true,
                'course' => $course
            ]
        );

    }
}
