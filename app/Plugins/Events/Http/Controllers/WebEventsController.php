<?php

namespace App\Plugins\Events\Http\Controllers;

use App\Classes\Helpers\Image;
use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\User\SiddhamahayogPortalUserController;
use App\Models\FailedRecord;
use App\Models\Portal\PortalCountry;
use App\Plugins\Events\Http\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class WebEventsController extends Controller
{
    protected $plugin_name = 'Events';

    public function index(string $slug) {

        if ( Cache::has('EVENT-DETAIL-'.$slug) ) {
            $event = Cache::get('EVENT-DETAIL-'.$slug);
        } else {
            $event = Event::where('event_slug',$slug)
                ->where('active',true)
                ->with(['getImage' => function($query){
                    $query->with('image');
                },'getSeo'])
                ->firstOrFail();
            Cache::put('EVENT-DETAIL-'.$slug,$event);
        }

        $data = [
            'extends'   => 'master-nav',
            'event'      => $event,
            'events'    => $this->getEvents()
        ];
        return view('Events::frontend.detail',$data);

    }

    public function events() {
        $data = [
            'extends'   => 'master',
            'events'    => $this->getEvents()
        ];
        return view('Events::frontend.list',$data);
    }

    public function getEvents() {

        if (Cache::has('FRONTEND_EVENTS_LISTS') ) {
            return Cache::get('FRONTEND_EVENTS_LISTS');
        }

        $events = Event::with(['getImage'=> function($query){
                            $query->with('image');
                        },'getComponents'])
                        ->where('active',true)
                        ->orderBy('event_start_date','asc')
                        ->get();
        Cache::put('FRONTEND_EVENTS_LISTS',$events);
        return $events;
    }

    public function eventRegistration(Request $request, string $event_slug, $step='first') {
        // $today.
        $today = Carbon::now();

        // get event name
        $event = Event::where('event_slug',$event_slug)
                        ->first();

        $data = [
            'extends'   => 'master-nav',
            'event'      => $event,
        ];

        $view = 'main';

        if ($request->ajax() ) {

            if ( ! session()->has('current_step')) {

                $view = 'validateAccount';
                session()->put('current_step','validateAccount');

            } else {

                $view = session()->get('current_step');
            }

            $view = view('Events::frontend.registration.partials.'.$view,$data)->render();
            return $this->json(true,'Form Loaded','',['view' =>$view]);

        }

        if ( ! $event ||  ! $event->active) {
            $view = 'expired';
        }
        return view ('Events::frontend.registration.'.$view,$data);
    }

    public function event_registration_process(Request $request, Event $event) {
        $data = ['event' => $event];

        $this->{session()->get('current_step')}($request,$event);
        $view = session()->get('current_step');

        $data['email'] = session()->get('registration-email');
        $view = view('Events::frontend.registration.partials.'.$view,$data)->render();

        return $this->json(true,'Information Loaded.','',['view' => $view]);

    }


    /**
     * Set Password and basic personal information field
     * @param Request $request
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function account(Request $request) {

        $request->validate([
            'password' => 'required|confirmed'
        ]);

        // create new account .
        $sessionRecord = session()->get('registration_detail');

        if ( ! count ( $sessionRecord) ) {

            $sessionRecord = [
                'password'  => true,
                'validated' => true,
                'has_password'  => true,
                'full_name' => '',
                'first_name'    => '',
                'middle_name'   => '',
                'last_name'     => '',
                'gender'        => '',
                'country'       => '',
                'city'          => '',
                'street_address'    => '',
                'phone_number'  => '',
                'date_of_birth' => '',
                'place_of_birth' => '',
                'meta'  => [],
                'dikshya'   => []
            ];
        }

        $sessionRecord['user_password'] = Hash::make($request->post('password'));
        session()->put('registration_detail',$sessionRecord);
        session()->put('current_step','personal');
    }

    public function personal(Request $request) {

        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'gender'        => 'required|in:male,female',
            'phone_number'  => 'required|numeric',
            'country'       => 'required|numeric',
            'state'         => 'required',
            'street_address'    => 'required',
            'date_of_birth' => 'required|date:Y-m-d',
            'place_of_birth'    => 'required',
            'education'     => 'required',
            'profession'    => 'required',
            'emergency_contact_person'  => 'required',
            'emergency_phone' => 'required',
            'emergency_contact_person_relation' => 'required',
            'reference_source' => 'required',
            'dikshya_type'  => 'required|in:dikshit,non-dikshit'
        ], [
            'emergency_contact_person_relation.required' => 'Please provide Your relation with emergency contact.',
            'emergency_phone.required' => 'Please provide phone number for emergency contact.',
            'emergency_contact_person.required' => 'Please provide emergency contact person full name.',
            'country.numeric.numeric' => 'Invalid Country selected.',
            'phone_number.numeric' => 'Invalid Phone Number.'
        ]);

        if ( $request->post('reference_source') == 'other') {
            $request->validate(['reference_source_detail' => 'required|min:5'],['reference_source_detail.min' => 'Please provide valid source detail.']);
        }

        if ( $request->post('reference_source') == 'friend') {
            $request->validate(['referer_name' => 'required']);
        }

        if (! in_array($request->post('education'),['primary','secondary']) ) {
            $request->validate([
                'field_of_study' => 'required'
            ],[
                'field_of_study' => 'Please provide your education major.'
            ]);
        }

        if ( $request->post('dikshya_type') == 'dikshit') {
            $request->validate(['dikshya_category' => 'required|in:tarak,saranagati,sadhana,sadhana&saranagati,sadhana&saranagati&tarak']);
        }

        $registrationDetail = session()->get('registration_detail');
        $registrationDetail['first_name'] = $request->post('first_name');
        $registrationDetail['middle_name']  = $request->post('middle_name');
        $registrationDetail['last_name'] = $request->post('last_name');
        $registrationDetail['gender'] = $request->post('gender');
        $registrationDetail['phone_number'] = $request->post('phone_number');
        $registrationDetail['country'] = $request->post('country');
        $registrationDetail['city']    = $request->post('state');
        $registrationDetail['street_address'] = $request->post('street_address');
        $registrationDetail['date_of_birth'] = $request->post('date_of_birth');
        $registrationDetail['place_of_birth'] = $request->post('place_of_birth');
        $registrationDetail['education'] = $request->post('education');
        $registrationDetail['education_major'] = $request->post('field_of_study');
        $registrationDetail['reference_source'] = $request->post('reference_source');
        $registrationDetail['referer_name'] = $request->post('referer_name');
        $registrationDetail['referer_relation'] = $request->post('referer_relation');
        $registrationDetail['reference_source_detail'] = $request->post('reference_source_detail');

        $full_name = $request->post('first_name');

        if ($request->post('middle_name') ) {
            $full_name .= ' ' . $request->post('middle_name');
        }
        $full_name .= ' ' . $request->post('last_name');

        $registrationDetail['full_name'] = $full_name;

        $registrationDetail['meta']['personal']['place_of_birth'] = $request->post('place_of_birth');
        $registrationDetail['meta']['personal']['date_of_birth'] = $request->post('date_of_birth');
        $registrationDetail['meta']['personal']['street_address'] = $request->post('street_address');
        $registrationDetail['meta']['personal']['gender'] = $request->post('gender');
        $registrationDetail['meta']['personal']['state'] = $request->post('state');

        $registrationDetail['meta']['education']['education'] = $request->post('education');
        $registrationDetail['meta']['education']['education_major'] = $request->post('field_of_study');
        $registrationDetail['meta']['education']['profession'] = $request->post('profession');

        $registrationDetail['emergency']['full_name'] = $request->post('emergency_contact_person');
        $registrationDetail['emergency']['phone_number'] = $request->post('emergency_phone');
        $registrationDetail['emergency']['relation'] = $request->post('emergency_contact_person_relation');


        $registrationDetail['dikshit']['type'] = $request->post('dikshya_type');
        $registrationDetail['dikshit']['category'] = $request->post('dikshya_category');

        // get country data

        $user = PortalCountry::where('id',$request->post('country'))->first();

        if ( $user ) {

            $registrationDetail['country_label'] = $user->name;
        }

        session()->put('registration_detail', $registrationDetail);
        session()->put('registration_detail',$registrationDetail);
        session()->put('current_step', 'emergencyContact');


    }

    public function validateAccount(Request $request, Event $event)
    {
        $siddhamahayogUser = new SiddhamahayogPortalUserController();
        $emailResponse = $siddhamahayogUser->userResponse($request);

        # If event is type live, ask for other detail
        if ( $event->event_type == 'live') {
            session()->put('registration-email' , $request->post('email'));

            if (count($emailResponse) && isset($emailResponse['first_name']) && isset($emailResponse['last_name'])) {
                session()->put('registration_detail', $emailResponse);
            }

            session()->put('current_step','liveZoomRegistration');
            return;
        }

        if ( isset ($emailResponse['has_submitted']) && $emailResponse['has_submitted'] === true) {
            session()->put('current_step','submitted');
            return;
        }

        session()->put('registration_detail',$emailResponse);

        if(isset($emailResponse['required_password']) && $emailResponse['required_password']) {
            session()->put('current_step','confirmPassword');
        } else {
            session()->put('new_registration' , true);
            session()->put('current_step', 'account');

        }


        session()->put('registration-email' , $request->post('email'));

    }

    public function emergencyContact(Request $request) {
        $request->validate([
            'family_member.*' => 'required',
            'family_relation.*' => 'required',
            'family_phone_number.*' => 'required',
            'family_gender.*' => 'required'
        ]);

        $registrationDetail = session()->get('registration_detail');

        $registrationDetail['family_detail']['members'] = [];
        $registrationDetail['family_detail']['total_member'] = $request->post('total_family_member');

        foreach ($request->post('family_member') ?? [] as $key => $family_detail) {

            $registrationDetail['family_detail']['members'][] = [
                'name' => $family_detail,
                'relation' => $request->post('family_relation')[$key],
                'phone_number' => $request->post('family_phone_number')[$key],
                'gender'    => $request->post('family_gender')[$key]
            ];
        }
        $registrationDetail['total_member_with_gurudev'] = $request->post('total_family_member_with_gurudev');
        session()->put('registration_detail',$registrationDetail);
        session()->put('current_step','yagyaInformation');
    }

    public function yagyaInformation(Request $request) {

        $request->validate([
            'jap_start_date' => 'required|date:Y-m-d',
            'total_jap_count' => 'required|numeric',
            'estimated_jap' => 'required|numeric'
        ]);

        $registrationDetail = session()->get('registration_detail');

        $registrationDetail['jap_detail'] = [
            'jap_start_date' => $request->post('jap_start_date'),
            'total_jap_count' => $request->post('total_jap_count'),
            'estimated_jap' => $request->post('estimated_jap')
        ];

        session()->put('registration_detail',$registrationDetail);
        session()->put('current_step','profilePictures');
    }

    public function profilePictures(Request $request) {
        $request->validate(
            [
                'profile_picture_default' => 'required|url',
                'profile_picture_id'    => 'required|url'
            ],
            [
                'profile_picture_default.required' => 'Please Upload your profile picture.',
                'profile_picture_default.url' => 'Unable to identify your picture detail.',
                'profile_picture_id.required' => 'Please upload your ID card',
                'profile_picture_id.url'    => 'Unable to identify your ID card',
            ]
        );

        $familyMemberDetail = session()->get('registration_detail');
        $familyMemberDetail['profile_url'] = $request->post('profile_picture_default');
        $familyMemberDetail['profile_id'] = $request->post('profile_picture_id');

        foreach ($familyMemberDetail['family_detail']['members'] as $key => $member) {

//            $request->validate([
//                'profile_picture_'.$key => 'required|url'
//            ],[
//                'profile_picture_'.$key.'.required' => 'Please Upload ' . $member['name'].' profile picture',
//                'profile_picture_'.$key.'.url' => 'Unable to identify  ' . $member['name'].' picture detail'
//            ]);

            $familyMemberDetail['family_detail']['members'][$key]['profile'] =  '';

        }

         // also save this information in siddhamahayog portal.

        session()->put('registration_detail',$familyMemberDetail);

        session()->put('current_step','complete');
    }

    public function complete() {

        $siddhamahayogUser = new SiddhamahayogPortalUserController();

        if ( !  $siddhamahayogUser->storeEventDetail() ) {

            $failedRecord = new FailedRecord();
            $sessionRecord = session()->get('registration_detail');
            $sessionRecord['email'] = session()->get('registration-email');
            $sessionRecord['new_user'] = session()->get('new_registration');

            $failedRecord->session_info = $sessionRecord;
            $failedRecord->save();
        }

        session()->forget('registration_detail');
        session()->forget('new_registration');
        session()->forget('registration-email');
        session()->forget('current_step');
    }

    public function stepBack(Request $request, Event $event){

            $currentStep = session()->get('current_step');

            if (in_array($currentStep,['confirmPassword','account','liveZoomRegistration','personal']) ) {
                session()->put('current_step','validateAccount');
            }

            if ( $currentStep == 'emergencyContact') {
                session()->put('current_step','personal');
            }

            if ( $currentStep == 'yagyaInformation') {
                session()->put('current_step','emergencyContact');
            }

            if ( $currentStep == 'profilePictures') {
                session()->put('current_step','yagyaInformation');
            }

            $finalStep =  session()->get('current_step');
            $data = ['event' => $event];
            $data['email'] = session()->get('registration-email');

            $view = view('Events::frontend.registration.partials.'.$finalStep,$data)->render();

            return $this->json(true,'Information Loaded.','',['view' => $view]);

    }
    public function uploadMedia(Request $request) {

        $image = Image::uploadOnly($request->file('image'));

        if (! $image ) {
            return $this->json(false,'Unable to upload file.');
        }

        return $this->json(true,'Image upload','',['image' => Image::getImageAsSize($image[0]->filepath,'m')]);
    }

    public function confirmPassword(Request $request) {
        $request->validate(
            [
                'password' => 'required',
            ],
        );

        if (! $request->post('email') != session()->get('registration-email') ) {
            return $this->json(false,'Invalid Username / Password');
        }

        $siddhamahayogUser = new SiddhamahayogPortalUserController();
        $verifyPassword = $siddhamahayogUser->verifyPassword($request);

        if ( $verifyPassword) {
            session()->put('current_step','personal');
            session()->put('has_validated_password',true);
            return;
        }
        session()->put('invalid_attempt','Invalid Username / Password');
    }

    function liveZoomRegistration(Request $request, Event $event) {

        $userModelController = new SiddhamahayogPortalUserController();
        $returnResponse = $userModelController->liveProgramEvent($request, $event->event_title);

        session()->put('zoom_registration','https://jagadguru.siddhamahayog.org/login/join-external?'.http_build_query($returnResponse));
        session()->put('current_step','zoomRegistrationComplete');
    }
}
