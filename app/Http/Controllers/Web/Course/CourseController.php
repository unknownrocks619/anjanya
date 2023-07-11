<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lession;
use App\Models\User;
use App\Models\UserCourseEnrollment;
use App\Models\UserWatchHistory;
use Illuminate\Http\Request;

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

    public function enroll(Request $request, Course $course)
    {

        if (!auth()->guard('web')->check()) {
            session()->put('intended', route('frontend.courses.', ['slug' => $course->slug]));
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
}
