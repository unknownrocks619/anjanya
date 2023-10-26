<?php

namespace App\Http\Controllers\Web\User;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\OrderController;
use App\Http\Requests\Web\User\AutheticateRequest;
use App\Jobs\MembershipRegistrationWelcomeJob;
use App\Jobs\ResubmitPinCodeJob;
use App\Jobs\SendInvitationLink;
use App\Jobs\SendResetLink;
use App\Jobs\sendVerificationEmailJob;
use App\Models\ApplicationRejectParams;
use App\Models\Book;
use App\Models\City;
use App\Models\Country;
use App\Models\FileRelation;
use App\Models\Image as ModelsImage;
use App\Models\MembershipApplication;
use App\Models\OrganisationStudent;
use App\Models\User;
use App\Models\UserCourseEnrollment;
use App\Models\UserMeta;
use App\Models\UserSadhanaMeta;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;

class UserController extends Controller
{
    //
    public function login()
    {
        return $this->user_theme('users.login');
    }

    public function dashboard()
    {
        $tabs = [
            'overview' => [
                'enrolled_course' => UserCourseEnrollment::getEnrolledCourse()->count(),
                'active_course' => UserCourseEnrollment::getActiveEnrolledCourse()->count(),
                'completed_courses' => UserCourseEnrollment::where('user_id', auth()->guard('web')->id())->where('completed', true)->count(),
                'books_uploaded'    => Book::where('upload_stage', '=', 'complete')->where('user_id', auth()->guard('web')->id())->count()
            ],
            'continue_learning' => UserCourseEnrollment::getActiveEnrolledCourse(),
            'books' => Book::where('status', '!=', '_begin')
                ->where('user_id', auth()->guard('web')->id())
                ->with(['getImage'])
                ->orderBy('id', 'desc')
                ->get()
        ];
        return $this->user_theme('dashboard', ['tabs' => $tabs]);
    }

    public function register(Request $request, $current_step = 'step_one')
    {
        if (!isset(User::REGISTRATION_STEPS[$current_step]) || !method_exists($this,  'store_' . User::REGISTRATION_STEPS[$current_step])) {
            abort(404);
        }
        if ($request->post() && !$request->has('steps')) {


            $session_record = session()->get(session()->getId());

            if (isset($session_record['personal_information']) && isset($session_record['personal_information']['_user'])) {
                $userInfo = User::with(['getUserSadhana'])->find(decrypt($session_record['personal_information']['_user']));

                if ($userInfo && $userInfo->current_step == 'complete') {
                    // $current_step = 'step_seven';
                }
            }


            $method = 'store_' . User::REGISTRATION_STEPS[$current_step];
            $method_return = $this->$method($request);

            if ($method_return) {
                return $method_return;
            }
        }

        if ($request->has('steps')) {
            return $this->backStep($current_step);
        }

        if (is_null(session()->get(session()->getId()))) {
            $manage_session = [
                'current_step' => $current_step,
                'personal_information'   => [],
                'education'    => [],
                'documents'    => [],
                'confirmation'  => []
            ];

            session()->put(session()->getId(), $manage_session);
        }

        $partial_view = 'frontend.registration.index' . User::REGISTRATION_STEPS[session()->get(session()->getId())['current_step']];

        return $this->frontend_theme('contact', 'registration.index', ['current_step' => session()->get(session()->getId())['current_step'], 'partial_view' => $partial_view]);
    }


    private function store_personal_information(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'landline_number'   => 'required',
            'mobile_number' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'perma_country' => 'required',
            'perma_state'   => 'required',
            'perma_street_address'  => 'required'
        ], [
            'perma_country.required' => 'Country Field is required.',
            'perma_state.required'  => 'State / City field is required.',
            'perma_street_address.required' => 'Street address is required.'
        ]);


        if (!$request->has('male') && !$request->has('female') &&  !$request->has('other')) {

            return $this->generateValidationError('male', 'Please select your gender');
        }

        if ($request->post('temp_country')) {
            $temp_country = Country::find($request->post('temp_country'));
        }
        if ($request->post('temp_state')) {
            $temp_state = City::find($request->post('temp_state'));
        }

        // validate email address.
        $existingUser = User::where('email', $request->post('email'))->first();
        $perma_country = Country::find($request->post('perma_country'));
        $perma_state = City::find($request->post('perma_state'));

        if ($existingUser && ($existingUser->current_step == 'complete'  || $existingUser->current_step == 'waiting')) {
        }

        $session_record = session()->get(session()->getId());

        if (empty($session_record['personal_information'])) {

            $user = new User();
        } else {
            $user = User::find(decrypt($session_record['personal_information']['_user']));
        }
        $user->fill([
            'first_name' => $request->post('first_name'),
            'last_name' => $request->post('last_name'),
            'email' => $request->post('email'),
            'password'  => Hash::make(\Illuminate\Support\Str::random(12)),
            'current_step'  => 'step_one',
            'invite_token'  => strtoupper(\Illuminate\Support\Str::random(12)),
            'date_of_birth' => $request->post('date_of_birth'),
            'phone_number' => $request->post('mobile_number'),
            'landline_number'   => $request->post('landline_number'),
            'country'     => $request->post('perma_country'),
            'state'   => $request->post('perma_state'),
            'street_address'  => $request->post('perma_street_address'),
            'perma_same_as_temp'    => $request->post('temporary_address_checkbox'),
            'temp_country'      => $request->post('temp_country'),
            'temp_state'        => $request->post('temp_state'),
            'temp_street_address'   => $request->post('temp_street_address'),
            'gender'        => $request->has('male') ? 'male'  : (($request->post('female') ? 'female' : 'other'))
        ]);

        if ($user->isDirty('email') && User::where('email', $request->post('email'))->exists()) {
            return response($this->generateValidationError('email', 'Email Already Exists.'), 422);
        }

        try {
            $user->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save.', '', ['errors' => $th->getMessage()]);
        }

        $personal_information = [
            'first_name'    => $request->post('first_name'),
            'middle_name'   => $request->post('middle_name'),
            'last_name'     => $request->post('last_name'),
            'email'         => $request->post('email'),
            'landline_number'   => $request->post('landline_number'),
            'mobile_number'     => $request->post('mobile_number'),
            'gender'            => $user->gender,
            'date_of_birth'     => $request->post('date_of_birth'),
            'perma_country'     => $request->post('perma_country'),
            'perma_state'       => $request->post('perma_state'),
            'perma_country_name'    => $perma_country->name,
            'perma_state_name'  => $perma_state->name,
            'perma_street_address'  => $request->post('perma_street_address'),
            'temp_same_as_perma'    => $request->has('temporary_address_checkbox') ? true : false,
            'temp_country'          => $request->post('temp_country'),
            'temp_state'            => $request->post('temp_state'),
            'temp_country_name'     => isset($temp_country) ? $temp_country->name : null,
            'temp_state_name'       => isset($temp_state) ? $temp_state->name : null,
            'temp_street_address'   => $request->post('temp_street_address'),
            '_user'         => encrypt($user->getKey()),
        ];
        $session_record['personal_information'] = $personal_information;
        $session_record['current_step'] = 'step_two';

        session()->put(session()->getId(), $session_record);
        return $this->returnPartials(true);
    }

    private function store_education_information(Request $request)
    {
        $request->validate([
            'education'       => 'required',
            'education_major' => 'required_unless:education,primary_school,middle_school',
            'citizenship_country' => 'required',
            'profession'           => 'required',
        ], [
            'education_major.required_unless'   => "Education Major is required.",
            'profession.requird' => 'The profession /occupation field is required.'
        ]);

        $session_record = session()->get(session()->getId());

        if (!$session_record['personal_information']) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }

        $userInfo = User::with(['getUserMeta'])->find(decrypt($session_record['personal_information']['_user']));
        $country  = Country::find($request->post('citizenship_country'));
        if (!$userInfo) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }

        $userMeta = $userInfo->getUserMeta;
        $education = [
            'level' => $request->post('education'),
            'education_major'   => $request->post('education_major'),
        ];

        if (!$userMeta) {
            $userMeta = new UserMeta();
        }

        $userMeta->education = $education;
        $userMeta->profession = $request->post('profession');
        $userMeta->user_id = $userInfo->getKey();
        $userInfo->current_step = 'step_two';
        $userInfo->citizenship_country = $request->post('citizenship_country');
        try {
            $userInfo->save();
            $userMeta->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save record.', '', ['error' => $th->getMessage()]);
        }

        $session_record['education_information'] = [
            'education' => $request->post('education'),
            'education_major'       => $request->post('education_major'),
            'citizenship_country'         => $request->post('citizenship_country'),
            'citizenship_country_name'      => $country->name,
            'profession'         => $request->post('profession')
        ];

        $session_record['current_step'] = 'step_three';
        session()->put(session()->getId(), $session_record);
        return $this->returnPartials(true);
    }

    private function store_guardian_and_emergency_contact(Request $request)
    {
        $request->validate([
            'emergency_contact_full_name' => 'required',
            'emergency_contact_number'  => 'required',
            'relation_to_emergency_contact' => 'required'
        ], [
            'emergency_contact_full_name' => 'Emergency Contact Person is required.',
            'emergency_contact_number'  => 'Emergency Contact Phone Number is required.',
            'relation_to_emergency_contact' => 'Relation with Emergency Contact is required.'
        ]);
        // get user age.
        $session_record = session()->get(session()->getId());

        if (!$session_record['personal_information']) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }
        $date_of_birth = $session_record['personal_information']['date_of_birth'];
        $currentDate = Carbon::now();
        $parseDOB = Carbon::parse($date_of_birth);

        if ($parseDOB->diffInYears() < 18) {
            $request->validate([
                'first_name_of_parent'  => 'required',
                'last_name_of_parent'      => 'required',
                'parent_relationship'   => 'required',
                'parent_email_address'  => 'nullable|email',
                'phone_number_of_parent'    => 'required'
            ], [
                'first_name_of_parent' => 'This field is required.',
                'last_name_of_parent'   => 'This field is required.',
                'parent_relationship'   => 'This field is required.',
                'parent_email_address'  => 'This field is required.',
                'phone_number_of_parent'    => 'This field is required.'
            ]);
        }

        $userInfo = User::with(['getUserMeta'])->find(decrypt($session_record['personal_information']['_user']));

        if (!$userInfo ||  !$userInfo->getUserMeta) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }
        $userMeta = $userInfo->getUserMeta;
        $gaurdians = [
            'first_name'  => $request->post('first_name_of_parent'),
            'last_name'     => $request->post('last_name_of_parent'),
            'relationship'  => $request->post('parent_relationship'),
            'email_address'  => $request->post('parent_email_address'),
            'phone_number'  => $request->post('phone_number_of_parent'),
            'is_sadhak'     => $request->has('parent_is_sadhak') ? true : false,
        ];
        $emergency = [
            'full_name' => $request->post('emergency_contact_full_name'),
            'contact' => $request->post('emergency_contact_number'),
            'relation'  => $request->post('relation_to_emergency_contact')
        ];
        $userMeta->gaurdian_info = $gaurdians;
        $userMeta->emergency_contact = $emergency;


        try {
            $userMeta->save();
            $userInfo->current_step = 'step_three';
            $userInfo->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save info.', '', ['error' => null]);
        }

        $session_record['guardian_and_emergency_contact'] = [
            'first_name_of_parent'          => $request->post('first_name_of_parent'),
            'last_name_of_parent'           => $request->post('last_name_of_parent'),
            'parent_relationship'           => $request->post('parent_relationship'),
            'parent_email_address'          => $request->post('parent_email_address'),
            'phone_number_of_parent'        => $request->post('phone_number_of_parent'),
            'parent_is_sadhak'              => $request->post('parent_is_sadhak'),
            'emergency_contact_full_name'   => $request->post('emergency_contact_full_name'),
            'emergency_contact_number'      => $request->post('emergency_contact_number'),
            'relation_to_emergency_contact' => $request->post('relation_to_emergency_contact')
        ];

        $session_record['current_step'] = 'step_four';
        session()->put(session()->getId(), $session_record);
        return $this->returnPartials(true);
    }


    private function store_dikshya_information(Request $request)
    {

        $request->validate([
            'shaktidikshya_date'    => 'required_if:shaktipaath_dikshya,on',
            'tarakdikshya_date'    => 'required_if:tarak_dikshya,on',
            'saranagatidikshya_date'    => 'required_if:saranagati_dikshya,on',
        ]);

        if ($request->post('shaktidikshya_date') == 'on' || $request->post('mantradikshya_date') == 'on' || $request->post('saranagatidikshya_date') == 'on') {
            $request->validate(['dikshit_name' => 'required']);
        }

        $session_record = session()->get(session()->getId());

        if (!$session_record['personal_information']) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }
        $userInfo = User::with(['getUserSadhana'])->find(decrypt($session_record['personal_information']['_user']));

        if (!$userInfo) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }

        if ($request->has('shaktipaath_dikshya')) {
            $shaktidikshayModel = $userInfo->getUserSadhana()->where('sadhana_type', 'shaktipaath_dikshya')->first();

            if (!$shaktidikshayModel) {
                $shaktidikshayModel = new UserSadhanaMeta;
            }
            $shaktidikshayModel->user_id = $userInfo->getKey();
            $shaktidikshayModel->sadhana_level = $request->post('shaktidikshya_level');
            $shaktidikshayModel->sadhana_type = 'shaktipaath_dikshya';
            $shaktidikshayModel->sadhana_date = $request->post('shaktidikshya_date');
            $shaktidikshayModel->save();
        }

        if ($request->has('tarak_dikshya')) {
            $mantraDikshyaModel = $userInfo->getUserSadhana()->where('sadhana_type', 'tarak_dikshya')->first();

            if (!$mantraDikshyaModel) {
                $mantraDikshyaModel = new UserSadhanaMeta;
            }
            $mantraDikshyaModel->user_id = $userInfo->getKey();
            $mantraDikshyaModel->sadhana_level = $request->post('tarakdikshya_level');
            $mantraDikshyaModel->sadhana_type = 'tarak_dikshya';
            $mantraDikshyaModel->sadhana_date = $request->post('tarakdikshya_date');
            $mantraDikshyaModel->save();
        }

        if ($request->has('saranagati_dikshya')) {
            $sarangatiDikshyaModel = $userInfo->getUserSadhana()->where('sadhana_type', 'saranagati_dikshya')->first();

            if (!$sarangatiDikshyaModel) {
                $sarangatiDikshyaModel = new UserSadhanaMeta;
            }
            $sarangatiDikshyaModel->user_id = $userInfo->getKey();
            $sarangatiDikshyaModel->sadhana_level = $request->post('saranagatidikshya_level');
            $sarangatiDikshyaModel->sadhana_type = 'saranagati_dikshya';
            $sarangatiDikshyaModel->sadhana_date = $request->post('saranagatidikshya_date');
            $sarangatiDikshyaModel->save();
        }

        if ($request->has('shaktidikshya_date') || $request->has('mantradikshya_date') || $request->has('saranagatidikshya_date')) {
            $userInfo->dikshit_name = $request->post('dikshit_name');
            $userInfo->save();
        }

        $session_record['dikshya_information'] = [
            'shaktidikshya_level'          => $request->post('shaktidikshya_level'),
            'shaktipaath_dikshya'           => $request->post('shaktipaath_dikshya'),
            'shaktidikshya_date'           => $request->post('shaktidikshya_date'),

            'tarakdikshya_level'          => $request->post('tarakdikshya_level'),
            'tarak_dikshya'        => $request->post('tarak_dikshya'),
            'tarakdikshya_date'              => $request->post('tarakdikshya_date'),

            'saranagatidikshya_level'   => $request->post('saranagatidikshya_level'),
            'saranagati_dikshya'      => $request->post('saranagati_dikshya'),
            'saranagatidikshya_date' => $request->post('saranagatidikshya_date'),

            'dikshit_name'          => $request->post('dikshit_name')
        ];

        $userInfo->current_step = 'step_four';
        $session_record['current_step'] = 'step_five';
        session()->put(session()->getId(), $session_record);
        return $this->returnPartials(true);
    }

    private function store_media_information(Request $request)
    {

        if (!$request->post('profile')) {
            return $this->generateValidationError('profile_error', 'Please upload your profile photo.');
        }

        if (!$request->post('verification_card')) {
            return $this->generateValidationError('verification_error', 'Please upload your identity card.');
        }

        $session_record = session()->get(session()->getId());

        if (!$session_record['personal_information']) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }
        $userInfo = User::find(decrypt($session_record['personal_information']['_user']));

        if (!$userInfo) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }

        // check if ids are valid.
        $profileID = $request->post('profile');
        $verificationCardID = $request->post('verification_card');

        $profileModel = ModelsImage::find($profileID);

        if (!$profileModel) {
            return $this->generateValidationError('profile_error', 'Please upload your photo.');
        }

        $verficationModel = ModelsImage::find($verificationCardID);

        if (!$verficationModel) {
            return $this->generateValidationError('verification_error', 'Please uploas your verification card.');
        }

        // estd relationship.
        $insertArray = [
            [
                'image_id' => $profileID,
                'relation'  => $userInfo::class,
                'relation_id'   => $userInfo->getKey(),
                'type'      => 'profile_picture',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ],
            [
                'image_id' => $verificationCardID,
                'relation'  => $userInfo::class,
                'relation_id'   => $userInfo->getKey(),
                'type'      => 'verification_card',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")

            ]
        ];

        try {
            FileRelation::insert($insertArray);
            $userInfo->current_step = 'step_five';
            $userInfo->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to upload your media.Please try again or reload your page.');
        }
        $session_record['media_information'] = [
            'profileID'          => $profileID,
            'verificationID'           => $verificationCardID,
        ];

        $session_record['current_step'] = 'step_six';
        session()->put(session()->getId(), $session_record);
        return $this->returnPartials(true);
    }

    private function store_terms_information(Request $request)
    {
        $request->validate([
            'applicant_signature' => 'required',
            'terms_accept'  => 'accepted'
        ], [
            'applicant_signature'   => 'Applicant signature is required.',
            'terms_accept'  => 'Please Accept our Terms and Conditions.'
        ]);

        $session_record = session()->get(session()->getId());

        if (!$session_record['personal_information']) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }
        $userInfo = User::with(['getUserMeta'])->find(decrypt($session_record['personal_information']['_user']));

        if (!$userInfo) {
            return $this->json(false, 'Something went wrong. Please Try again.', 'redirect', ['location' => route('frontend.users.register', ['current_step' => 'step_one'])]);
        }

        $userDateBirth = Carbon::parse($userInfo->date_of_birth);
        if ($userDateBirth->diffInYears() < 18) {
            $request->validate([
                'parent_full_name' => 'required'
            ], ['parent_full_name' => 'Guardian Signature is required.']);
        }
        $userInfo->terms = true;
        $userInfo->current_step = 'complete';

        $userMeta = $userInfo->getUserMeta;
        $userMeta->parent_signature = $request->post('parent_full_name');
        $userMeta->signature = $request->post('applicant_signature');

        try {
            $userMeta->save();
            $userInfo->save();

            // now check.
            $membershipApplication = MembershipApplication::where('user_id', $userInfo->getKey())->first();

            if (!$membershipApplication) {
                $membershipApplication = new MembershipApplication();
                $membershipApplication->fill([
                    'user_id' => $userInfo->getKey(),
                    'application_type'  => 'submitted',
                    'status'    => "pending",
                    'resubmitted_count' => 0
                ]);
            } else {
                $membershipApplication->status = 'pending';
                $membershipApplication->resubmitted_count = $membershipApplication->resubmitted_count + 1;
            }
            $membershipApplication->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(true, 'Unable to update information');
        }

        $session_record['terms_info'] = [
            'terms'          => $request->post('terms_accept'),
            'applicant_signature'           => $request->post('shaktipaath_dikshya'),
            'parent_full_name'           => $request->post('parent_full_name'),
        ];

        $session_record['current_step'] = 'step_seven';
        session()->put(session()->getId(), $session_record);
        MembershipRegistrationWelcomeJob::dispatch($userInfo);
        return $this->returnPartials(true);
    }


    public function updateMedia(Request $request)
    {
        $uploadImage = Image::uploadOnly($request->file('file'))[0];
        $jsCallback = '';
        if ($request->get('type') == "profile") {
            $jsCallback = 'identityPhoto';
        }
        if ($request->get('type') == 'verification_card') {
            $jsCallback = 'verificationPhoto';
        }
        return $this->json(true, 'File uploaded', $jsCallback, ['info' => $uploadImage?->getKey()]);
    }
    private function backStep($current_step = 'step_one')
    {
        $currentInformation = session()->get(session()->getId());

        if ($current_step == 'step_two') {
            $currentInformation['current_step'] = 'step_one';
            session()->put(session()->getId(), $currentInformation);
        }

        if ($current_step == 'step_three') {
            $currentInformation['current_step'] = 'step_two';
            session()->put(session()->getId(), $currentInformation);
        }

        if ($current_step == 'step_four') {
            $currentInformation['current_step'] = 'step_three';
            session()->put(session()->getId(), $currentInformation);
        }

        if ($current_step == 'step_five') {
            $currentInformation['current_step'] = 'step_four';
            session()->put(session()->getId(), $currentInformation);
        }

        if ($current_step == 'step_six') {
            $currentInformation['current_step'] = 'step_five';
            session()->put(session()->getId(), $currentInformation);
        }

        if ($current_step == 'step_seven') {
            $currentInformation['current_step'] = 'step_six';
            session()->put(session()->getId(), $currentInformation);
        }

        return $this->returnPartials(true);
    }

    public function autheticate(AutheticateRequest $request)
    {
        $request->autheticateUser();

        $userProfileComplete = $request->ensureUserProfileComplete();
        if ($userProfileComplete) {

            if (is_string($userProfileComplete)) {
                return $this->json(true, '', 'redirect', ['location' => $userProfileComplete]);
            }
            return $userProfileComplete;
        }
        // check if order line is active.

        $orderCheck = new OrderController;
        $order = $orderCheck->order($request->getCurrentOrderID());
        $request->session()->regenerate();

        if ($order) {
            $user = auth()->guard('web')->user();
            $order->session_id = session()->getId();
            $order->first_name = $user->first_name;
            $order->last_name = $user->last_name;
            $order->email = $user->email;
            $order->phone_number = $user->phone_number;

            $order->save();
        }

        if ($request->ajax() && $request->has('__ref') && $request->__ref == 'order') {
            return $this->json(true, __('web/login.login_success'), 'redirect', ['location' => route('frontend.orders.checkout')]);
        }

        return $this->json(true, __('web/login.login_success'), 'redirect', ['location' => route('frontend.users.dashboard', ['_ref' => 'postLogin'])]);
    }


    public function updateUserOrganisaction(Request $request)
    {

        if (!auth()->guard('web')->check()) {
            abort(404);
        }

        //
        $user = auth()->guard('web')->user();

        $userCurrentOrg = $user->getOrganisation;

        if ($userCurrentOrg && $request->post('university')) {
            return $this->json(true, 'Your Information Update.');
        }

        if ($userCurrentOrg) {
            $userCurrentOrg->active = false;
            $userCurrentOrg->save();
        }

        $newOrganisation = new OrganisationStudent;
        $newOrganisation->fill([
            'active' => true,
            'user_id'   => $user->getKey(),
            'org_id'    => $request->post('university'),
            'role'      => $user->role
        ]);

        try {
            $newOrganisation->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save information.');
        }

        return $this->json(true, 'Organisation Information Updated.', 'reload');
    }


    public function send_verification(Request $request, User $user = null)
    {

        if ($request->post()) {
            if (!$user) {
                $session_user = session()->get(session()->getId());

                if (!$session_user) {
                    return $this->json(false, 'Something went wrong. Please try again.');
                }

                $user = User::find(decrypt($session_user['account_information']['_user']));
            }

            sendVerificationEmailJob::dispatch($user);
            return $this->json(true, 'Email Sent.');
        }

        // verify email.
        if (!$user) {
            abort(404);
        }

        $user->email_verified_at = now();
        $user->status = 'active';
        $user->current_step = 'complete';

        $user->save();

        $manage_session = [
            'current_step' => 'complete',
            'account_information'   => [],
            'basic_info'    => [],
            'canva_info'    => []
        ];

        session()->put(session()->getId(), $manage_session);
        return redirect()->route('frontend.users.register', ['current_step' => 'complete']);
    }

    public function store_complete(Request $request)
    {
    }

    public function confirmShare(Request $request, string $token)
    {
        if (!$request->hasValidSignature()) {
            abort(404);
        }
        // check if token exists.
        $user = User::where('invite_token', $token)->where('role', 'teacher')
            ->where('status', 'active')
            ->firstOrFail();
        $organisation = $user->getOrganisation;

        if (!$organisation) {
            abort(404);
        }

        $manage_session = [
            'current_step' => 'step_one',
            'account_information'   => [],
            'basic_info'    => [],
            'canva_info'    => [],
            'invite'        => true,
            'organisation_id'  => encrypt($organisation->org_id),
            'invite_through'    => $token
        ];
        session()->put(session()->getId(), $manage_session);
        return redirect()->route('frontend.users.register', ['_ref' => $token]);
    }

    public function invite_email(Request $request)
    {
        $request->validate([
            'emails' => 'required'
        ]);
        $emails = explode(',', $request->post('emails'));
        $shareLink = URL::temporarySignedRoute('frontend.users.invite_user', now()->addHours(2), ['token' => auth()->guard('web')->user()->invite_token]);
        try {
            //code...
            SendInvitationLink::dispatch($emails, $shareLink);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return $this->json(true, 'Invitation Sent');
    }

    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        session()->regenerate();
        if ($request->ajax()) {
            return $this->json(true, 'Logout Successful !', 'redirect', ['location' => route('frontend.users.login')]);
        }
        return redirect()->route('frontend.users.login');
    }

    public function reset(Request $request)
    {
        if ($request->post()) {

            $request->validate([
                'email' => 'required|email'
            ]);

            $user = User::where('email', $request->post('email'))->where('status', 'active')->first();

            if ($user) {
                $signedUrl = URL::temporarySignedRoute('frontend.users.confirm_reset_password', now()->addMinutes(30), ['user' => $user]);
                SendResetLink::dispatch($user, $signedUrl);
            }

            return $this->json(true, 'Reset Link Has been sent to your email address.');
        }
        return $this->user_theme('users.reset');
    }

    public function confirm_reset(Request $request, User $user)
    {
        if (!$request->hasValidSignature()) {
            abort(404);
        }
        return $this->user_theme('users.change-password', ['user' => $user]);
    }

    public function store_reset_password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        if (!$request->post('email') || !$request->post('user')) {
            return response($this->generateValidationError('password', 'Invalid Request'));
        }

        $user = User::find(decrypt($request->post('user')));

        if (!$user) {
            return response($this->generateValidationError('password', 'Invalid Request'));
        }

        $user->password = Hash::make($request->post('password'));
        $user->save();

        return $this->json(true, 'Password Successfully Change.', 'redirect', ['location' => route('frontend.users.login', ['_ref' => 'reset_confirmation'])]);
    }

    private function returnPartials($state)
    {
        $current_step = session()->get(session()->getId())['current_step'];
        $viewPath = 'registration.steps.' . User::REGISTRATION_STEPS[$current_step];
        $partial_view = $this->user_theme($viewPath, ['current_step' => $current_step])->render();
        return $this->json(
            $state,
            '',
            'registrationNext',
            ['view' => $partial_view, 'current_step' => $current_step]
        );
    }

    public function resubmit()
    {
        if (request()->method() === 'POST') {
            return $this->checkResubmitEmail(request());
        }
        return $this->frontend_theme('contact', 'registration.resubmit');
    }

    public function checkResubmitEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // get user info using email.
        $userInfo = User::where('email', $request->post('email'))->first();

        if (!$userInfo) {
            return $this->generateValidationError('email', 'Invalid Email Address.');
        }
        $pin = mt_rand(10000000, 99999999);
        $string = str_shuffle($pin);

        session()->put('resubmit_key', ['key' => encrypt($string), '_id' => $userInfo->getKey()]);
        ResubmitPinCodeJob::dispatchSync($userInfo, $string);
        return $this->json(true, 'Please check your email.', 'redirect', ['location' => route('frontend.users.resubmit_application_pin')]);
    }

    public function resubmit_pin(Request $request)
    {
        if (!session()->has('resubmit_key')) {
            $route = route('frontend.users.resubmit_application');
            if ($request->ajax()) {
                return $this->json(false, 'Oops ! Something went wrong.', 'redirect', ['location' => $route]);
            }
            return redirect()->to($route);
        }

        if ($request->method() == 'POST') {
            $request->validate([
                'pin' => 'required'
            ]);
            $ip = $request->ip();
            event(new Lockout($request));
            RateLimiter::availableIn($ip);

            if (RateLimiter::tooManyAttempts($ip, 3)) {
                session()->forget('resubmit_key');
                session()->flash('error', 'Too Many Attempt. Please try again after five minute.');
                return redirect()->route('frontend.users.resubmit_application');
            }

            $pin = implode('', $request->post('pin'));

            $sessionValud = session()->get('resubmit_key');
            if ((int) decrypt($sessionValud['key']) !== (int) $pin) {
                RateLimiter::hit($ip);
                session()->flash('error', 'Invalid Pin code. Please try again.');
                return redirect()->back();
            }
            return $this->manageSession();
        }
        return $this->frontend_theme('contact', 'registration.pin');
    }

    public function manageSession()
    {
        $sesionKey = session()->get('resubmit_key')['_id'];
        $session_variation = [
            'personal_information'  => [],
            'education_information' => [],
            'guardian_and_emergency_contact'    => [],
            'dikshya_information'   => [],
            'media_information'     => [],
            'terms_info'            => [],
        ];
        $userInfo = User::find($sesionKey);
        $personal_information = [
            'first_name' => $userInfo->first_name,
            'middle_name'   => $userInfo->middle_name,
            'last_name'     => $userInfo->last_name,
            'email'         => $userInfo->email,
            'landline_number'   => $userInfo->landline_number,
            'mobile_number' => $userInfo->phone_number,
            'gender'        => $userInfo->gender,
            'date_of_birth' => $userInfo->date_of_birth,
            'perma_country' => $userInfo->country,
            'perma_state'   => $userInfo->state,
            'perma_street_address'  => $userInfo->street_address,
            'perma_country_name'    => ($userInfo->country) ? Country::find($userInfo->country)->name : '',
            'perma_state_name'      => ($userInfo->state) ? City::find($userInfo->state)->name : '',
            'temp_country'          => $userInfo->temp_country,
            'temp_state'            => $userInfo->temp_state,
            'temp_street_address'   => $userInfo->temp_street_address,
            'temp_country_name'     => $userInfo->temp_country ? Country::find($userInfo->temp_country)->name : '',
            'temp_state_name'       => $userInfo->temp_state ? City::find($userInfo->temp_state)->name : null,
            'temp_same_as_perma'    => $userInfo->perma_same_as_temp,
            '_user'                 => encrypt($userInfo->getKey())
        ];
        $session_variation['personal_information'] = $personal_information;
        $userMeta = $userInfo->getUserMeta;

        if ($userMeta) {

            $education_information = [
                'education'    => $userMeta->education?->level,
                'education_major'   => $userMeta->education?->education_major,
                'citizenship_country' => $userInfo->citizenship_country,
                'citizenship_country_name'  => ($userInfo->citizenship_country)  ? Country::find($userInfo->citizenship_country)->name : 'Please Select country',
                'profession'        => $userMeta->profession
            ];
            $session_variation['education_information'] = $education_information;

            $guardian_and_emergency_contact = [
                'first_name_of_parent'          => $userMeta->gaurdian_info?->first_name,
                'last_name_of_parent'           => $userMeta->gaurdian_info?->last_name,
                'parent_relationship'           => $userMeta->gaurdian_info?->relationship,
                'parent_email_address'          => $userMeta->gaurdian_info?->email_address,
                'phone_number_of_parent'        => $userMeta->gaurdian_info?->phone_number,
                'parent_is_sadhak'              => $userMeta->gaurdian_info?->is_sadhak ?? false,
                'emergency_contact_full_name'   => $userMeta->emergency_contact?->full_name,
                'emergency_contact_number'      => $userMeta->emergency_contact?->contact,
                'relation_to_emergency_contact' => $userMeta->emergency_contact?->relation

            ];
            $session_variation['guardian_and_emergency_contact'] = $guardian_and_emergency_contact;
        }

        $sadhana = $userInfo->getUserSadhana;
        if ($sadhana) {
            $shaktipaathDiskhya = $sadhana->where('sadhana_type', 'shaktipaath_dikshya')->first();
            $tarak_dikshya  = $sadhana->where('sadhana_type', 'tarak_dikshya')->first();
            $saranagati_dikshya  = $sadhana->where('sadhana_type', 'saranagati_dikshya')->first();

            $dikshya_information = [
                'shaktidikshya_level'          => $shaktipaathDiskhya?->sadhana_level,
                'shaktipaath_dikshya'           => $shaktipaathDiskhya ? 'on' : null,
                'shaktidikshya_date'           => $shaktipaathDiskhya?->sadhana_date,

                'tarakdikshya_level'          => $tarak_dikshya?->sadhana_level,
                'tarak_dikshya'        => $tarak_dikshya ? 'on' : null,
                'tarakdikshya_date'              => $tarak_dikshya?->sadhana_date,

                'saranagatidikshya_level'   => $saranagati_dikshya?->sadhana_level,
                'saranagati_dikshya'      => $saranagati_dikshya ? 'on' : null,
                'saranagatidikshya_date' => $saranagati_dikshya?->sadhana_date,

                'dikshit_name'          => $userInfo->dikshit_name
            ];

            $session_variation['dikshya_information'] = $dikshya_information;
        }

        $userProfile = FileRelation::where('relation', $userInfo::class)
            ->where('relation_id', $userInfo->getKey())
            ->where('type', 'profile_picture')
            ->latest()
            ->first();

        $userVerificationCard = FileRelation::where('relation', $userInfo::class)
            ->where('relation_id', $userInfo->getKey())
            ->where('type', 'verification_card')
            ->latest()
            ->first();


        $media_information = [
            'profileID' => $userProfile?->getKey(),
            'verificationID'    => $userVerificationCard?->getKey(),
        ];

        $session_variation['media_information'] = $media_information;

        // check if application was rejected.
        $rejectedApplication = ApplicationRejectParams::where('user_id', $userInfo->getKey())->latest()->first();
        $applicationStatus = MembershipApplication::where('user_id', $userInfo->getKey())->latest()->first();

        $session_variation['current_step'] = 'step_one';
        if (!$applicationStatus) {
            $session_variation['current_step'] = $userInfo::REGISTRATION_STEP_BACK[$userInfo->current_step];
            session()->forget('resubmit_key');
            session()->put(session()->getId(), $session_variation);
            redirect()->route('frontend.users.register');
        }

        if ($applicationStatus->status == 'approved') {
            // send message as application already approved.
            session()->forget('resubmit_key');
            session()->flash('success', 'Your account has already been approved.');
            return redirect()->route('frontend.users.resubmit_application');
        }

        if ($applicationStatus->status == 'pending') {
            // sending message as your application is still under review.
            session()->forget('resubmit_key');
            session()->flash('success', 'Your application is still pending. You will be notified once your application status is updated.');
            return redirect()->route('frontend.users.resubmit_application');
        }

        if ($rejectedApplication && $applicationStatus) {
            $session_variation['current_step'] = $rejectedApplication->step_params;
        } else {
            $session_variation['current_step'] = $userInfo::REGISTRATION_STEP_BACK[$userInfo->current_step];
        }

        if ($rejectedApplication->step_params == 'step_five') {
            $session_variation['media_information'] = [];
        }
        session()->put(session()->getId(), $session_variation);
        session()->forget('resubmit_key');
        return redirect()->route('frontend.users.register');
    }
}
