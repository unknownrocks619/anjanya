<?php

namespace App\Plugins\Volunteer\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\User\SiddhamahayogPortalUserController;
use App\Models\Portal\MemberDikshya;
use App\Models\Portal\MemberEmergencyMeta;
use App\Models\Portal\MemberInfo;
use App\Models\Portal\ProgramVolunteer;
use App\Models\Portal\ProgramVolunteerDates;
use App\Models\Portal\UserModel;
use App\Rules\Unicode;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WebVolunteerController extends  Controller
{

    protected $programID = 5;

    public $plugin_name = 'Volunteer';

    const DEFAULT = 'validateAccount';
    const STEPS =[
        'validateAccount',
        'personal',
        'volunteerParticipation',
        'volunteerData',
        // 'volunteerInterest',
        'profile',
        'confirmation',
    ];
    public function register(Request $request) {
        $data = [
            'extends'   => 'master-nav',
        ];

        return view($this->plugin_name.'::frontend.registration.main',$data);
    }

    public function volunteerRegistration(Request $request) {

        $request->validate(['step' => 'required']);

        if ( ! method_exists($this,$request->post('step'))) {
            return $this->json(false,'Invalid Request.');
        }

        return $this->{$request->post('step')}($request);

    }

    /**
     * Validate Account
     */
    public function validateAccount(Request $request) {

        if ( $request->ajax() && ! $request->post() ) {
            return $this->json (true,'Content Loaded','',['view' =>view($this->plugin_name.'::frontend.registration.partials.validateAccount')->render()]);
        }

        if ( ! $request->ajax() && ! $request->post()) {
            $data = [
                'extends'   => 'master-nav',
            ];
            return view($this->plugin_name.'::frontend.registration.main',$data);
        }

        $request->validate([
            'email' => 'required|email'
        ]);

        $siddhamahayogUser = new SiddhamahayogPortalUserController();
        $user = $siddhamahayogUser->userResponse($request);
        $this->saveSession('initialSession' , ['_userInputEmail' => encrypt($request->post('email'))]);

        if ( ! $user ) {
            return $this->json(true,'Validation Success.','',['view' => view($this->plugin_name.'::frontend.registration.partials.new-password',['email' => $request->post('email')])->render()]);
        }
    
        $view = view($this->plugin_name.'::frontend.registration.partials.password-confirmation',['email' => $request->post('email')])->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);
    }


    public function setupAccount(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password'  => 'required|min:6|confirmed'
        ]);

        /**
         * Now Check initial entry and current email address matches.
         */
        $userEmail = $this->getSession('initialSession','_userInputEmail');
        
        if (is_null($userEmail) ) {
            $request->validate(['email' => 'in:'.Str::random(16)],['email.in' => 'Invalid Email Address.']);
        }

        $userEmail = decrypt($userEmail);
        
        if ($userEmail != $request->post('email')  ) {
            $request->validate(['email' => 'in:'.Str::random(16)],['email.in' => 'Invalid Email Address.']);
        }

        $this->saveSession('_accountSetup',[
            'email' => $request->post('email'),
            'password'  => Hash::make($request->post('password'))
        ]);

        $view = view($this->plugin_name.'::frontend.registration.partials.personal',['email' => $request->post('email'),'member' => null,'previous' => 'validateAccount'])->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);

        
    }

    public function passwordConfirmation(Request $request) {
        
        $request->validate([
            'email' => 'required|email',
            'password'  => 'required',
        ]);

        /**
         * Now Check initial entry and current email address matches.
         */
        $userEmail = $this->getSession('initialSession','_userInputEmail');

        if (is_null($userEmail) ) {
            $request->validate(['email' => 'in:'.Str::random(16)],['email.in' => 'Invalid Email Address.']);
        }

        $userEmail = decrypt($userEmail);

        if ($userEmail != $request->post('email')  ) {
            $request->validate(['email' => 'in:'.Str::random(16)],['email.in' => 'Invalid Email Address.']);
        }

        $member = UserModel::where('email',$request->post('email'))->first();
        if (! $member ) {
            $request->validate(['email' => 'in:'.Str::random(16)],['email.in' => 'Invalid Email or Password.']);
        }

        // check
        if ( ! Hash::check($request->post('password'),$member->password) ) {
            return $this->json(false,'Invalid Email or Password.');
        }

        $this->saveSession('_personal',$member);
        $view = view($this->plugin_name.'::frontend.registration.partials.personal',['email' => $request->post('email'),'member' => null,'previous' => 'validateAccount'])->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);


    }

    public function personal(Request $request) {

        if ( $request->ajax() && ! $request->post() ) {
            return $this->json (true,'Content Loaded','',['view' =>view($this->plugin_name.'::frontend.registration.partials.personal')->render()]);
        }

        if ( ! $request->ajax() && ! $request->post()) {
            $data = [
                'extends'   => 'master-nav',
            ];
            return view($this->plugin_name.'::frontend.registration.main',$data);
        }


        $request->validate([
            'first_name' => ['required','string',new  Unicode()],
            'middle_name'  => ['nullable','string',new  Unicode()],
            'last_name'  => ['required','string',new  Unicode()],
            'gender'        => ['required','string',Rule::in(['male','female']),new Unicode()],
            'phone_number' => ['required','integer',new Unicode()],
            'country'       => ['required','integer',new  Unicode()],
            'state'         => ['required','string',new  Unicode()],
            'street_address'    => ['required','string',new  Unicode()],
            'date_of_birth' => ['required','date','date_format:Y-m-d', new Unicode()],
            'place_of_birth'    => ['required','string', new Unicode()],
            'education'     => ['required','string', new Unicode()],
            'emergency_contact_person' => ['required','string', new Unicode()],
            'emergency_contact_person_relation' => ['required','string',new Unicode()],
            'emergency_phone' => ['required',new Unicode()]
        ]);

        try {
            $member = DB::transaction(function() use ($request) {

                    $member = $this->getSession('_personal');

                    if ( ! $member ) {

                        $member  = new UserModel();
                        $member->fill($request->except(['_token','state','street_address','place_of_birth','education']));
                        $member->full_name = $member->full_name_with_middle();
                        $member->city = $request->post('state');
                        $member->email =  $this->getSession('_accountSetup','email');
                        $member->password = $this->getSession('_accountSetup','password');
                        $member->address = ['street_address' => $request->post('street_address')];
                        $member->source = 'Volunteer Form';
                        $member->role_id = 7;               
    
                    }
                    
                    $member->gotra = $request->post('gotra');
                    $member->phone_number = $request->post('phone_number') ? $request->post('phone_number') : $member->getOriginal('phone_number');
                    $member->date_of_birth = $request->post('date_of_birth');


                    if ( ! $member->member_uuid ) {

                        $member->member_uuid = Str::uuid();
                    } 

                    /**
                     * Save Member Info
                     */
                    $member->save();
                    
                    $meta = $member->meta;

                    if ( ! $meta ) {

                        $meta = new MemberInfo();
                    }

                    $meta->fill([
                        'history' => [
                            'medicine_history' => null,
                            'mental_health_history' => null,
                            'support_in_need' => null,
                            'regular_medicine_history_detail' => null,
                            'mental_health_detail_problem'  => null,
                            'practiced_info' => null,
                            'terms_and_condition' => null,
                            'sadhak'    => ($request->post('dikshya_type') == 'no') ? 'yes' : 'no'
                        ],
                        'personal' => [
                            'place_of_birth' => $request->post('place_of_birth'),
                            'date_of_birth' => $request->post('date_of_birth'),
                            'stret_address' => $request->post('street_address'),
                            'state' => $request->post('state'),
                            'gender'    => $request->post('gender')
                        ],
                        'education' => [
                            'education' => $request->post('education'),
                            'education_major'  => $request->post('profession'),
                            'profession'    => $request->post('field_of_study')
                        ],
                        'member_id' => $member->getKey()
                    ]);
                    
                    $meta->save();

                    $emergency = $member->emergency;

                    if ( ! $emergency ) {
                        $emergency = New MemberEmergencyMeta();
                    }

                    $emergency->fill([
                        'contact_person' => $request->post('emergency_contact_person'),
                        'relation'  => $request->post('emergency_contact_person_relation'),
                        'phone_number'  => $request->post('emergency_phone'),
                        'member_id' => $member->getkey()
                    ]);
                    
                    $emergency->save();

                    $dikshya = $member->diskshya;

                    $memberDikshyaInfo = [];

                    if ($request->post('dikshya_type') == 'dikshit') {
                        if (! $dikshya ) {

                            $dikshya = new MemberDikshya();
                            $dikshya->dikshya_type = $request->post('dikshya_category');
                            $dikshya->member_id = $member->getKey();
                            $dikshya->rashi_name = '-';
                            $dikshya->ceromony_location = '-';
                            $dikshya->save();
                        }
                        
                    }
                    
                    $this->saveSession('_personal', $member);
                    return $member;
            });
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th);
            return $this->json(false,'Unable to update your personal information.'. $th->getMessage());
        }
                
        $hanumandYagya = $this->getSession('program_info');
        $view = view($this->plugin_name.'::frontend.registration.partials.volunteerParticipation',['email' => $member->email,'member' => $member,'hanumandYagyaInfo' => $hanumandYagya])->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);
    }


    public function volunteerParticipation(Request $request){

        if ( $request->ajax() && ! $request->post() ) {
            return $this->json (true,'Content Loaded','',['view' =>view($this->plugin_name.'::frontend.registration.partials.personal')->render()]);
        }

        if ( ! $request->ajax() && ! $request->post()) {
            $data = [
                'extends'   => 'master-nav',
            ];
            return view($this->plugin_name.'::frontend.registration.main',$data);
        }

        $request->validate([
            'jaap_anushthan' => 'required|in:yes,no',
            'previous_volunteer'    => 'required|in:yes,no'
        ]);


        $member = $this->getSession('_personalInfo') ?? $this->getSession('_personal');
        
        if ( ! $member ) {
            return $this->json(false,'Invalid Request.',null);
        }


        $this->saveSession('_volunteerParticipation',['jaap_anushthan' => $request->post('jaap_anushthan'),'previous_volunteer' => $request->post('previous_volunteer')]);
        $volunteerData = $this->getSession('_volunteerData');
        $view = view($this->plugin_name.'::frontend.registration.partials.volunteerData',['volunteerData' => $volunteerData])->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);

    }


    public function profile(Request $request) {

        $request->validate([
            'profile_picture' => 'required|url',
            'id_card_picture'   => 'required|url',
        ],[
            'profile_picture.required' => 'Pleae Upload your profile picture.',
            'profile_picture.required' => 'Pleae Upload your profile picture.',
            'id_card_picture.required' => 'Pleae Upload your ID Card.',
            'id_card_picture.required' => 'Pleae Upload your ID Card.'
        ]);
        
        $member = $this->getSession('_personalInfo') ?? $this->getSession('_personal');

        if ( ! $member ) {
            return $this->json(false,'Invalid Request.',null);
        }


        try {
            DB::transaction( function () use($request,$member) {
                /**
                 * Update this information in member table.
                 */

                $uploadedProfilePicture = pathinfo($request->post('profile_picture'),PATHINFO_BASENAME);
                $idProfilePicture = pathinfo($request->post('id_card_picture'),PATHINFO_BASENAME);

                $personalProfile = $member->profileImage()->where('relation_id',$member->getKey())->latest()->first();
                $personalID = $member->memberIDMedia()->where('relation_id',$member->getKey())->latest()->first();
            

                $profile = ['full_path' => $request->post('profile_picture'),'id_card' => $request->post('id_card_picture')];

                if ($personalProfile) {
                    $userImage = pathinfo($personalProfile->filepath,PATHINFO_BASENAME);

                    if($userImage == $uploadedProfilePicture) {
                        unset($profile['full_path']);
                    }

                }

                if ($personalID) {
                    $userImage = pathinfo($personalID->filepath,PATHINFO_BASENAME);

                    if($userImage == $idProfilePicture) {
                        unset($profile['id_card']);
                    }

                }
                
                $member->profile = (count($profile) == 0) ? null : $profile;
                $member->save();

                /**
                 * Insert Other Records
                 */


                // check if user is already in volunteer table.
                        
                $programVolunteer = ProgramVolunteer::where('member_id',$member->getKey())->where('program_id',$this->programID)->first();
            
                if ( ! $programVolunteer ) {
                    
                    $volunteerProgramDetail = $this->getSession('_volunteerParticipation');
                    $volunteerData = $this->getSession('_volunteerData');

                    $programVolunteer = new ProgramVolunteer();
                    $programVolunteer->fill([
                        'program_id' => $this->programID,
                        'member_id' => $member->getKey(),
                        'volunteer_group_id' => 0,
                        'full_name' => $member->full_name,
                        'gotra' => $member->gotra,
                        'email' => $member->email,
                        'phone_number'  => $member->phone_number,
                        'country'       => $member->portalCountry?->name ?? $member->country,
                        'full_address'  => $member->city .', ' . $member->address->street_address,
                        'education'     => $member->meta?->education?->education,
                        'gender'        => $member->gender,
                        'profession'    => $member->meta?->education?->profession,
                        'involved_in_program' => ($volunteerProgramDetail['jaap_anushthan'] ?? 'no' == 'yes') ? 1 : 0,
                        'was_involved_in_volunteer' => ($volunteerProgramDetail['previous_volunteer'] ?? 'no' == 'yes') ? 1 : 0,
                        'confirm_presence'  => $volunteerData['confirm_presence'] ?? 0,
                        'accept_terms_and_conditions'   => $volunteerData['accept_rules_and_regulation'] ?? 0,
                    ]);

                    
                    $programVolunteer->save();

                    if (count($volunteerData['dateCheckBox']?? [])){

                        foreach ($volunteerData['dateCheckBox'] as $date) {

                            $volunteerDates = new ProgramVolunteerDates();

                            $volunteerDates->fill([
                                'member_id' => $member->getKey(),
                                'program_volunteer_id'  => $programVolunteer->getKey(),
                                'available_dates'   => $date,
                                'status'    => 'pending'
                            ]);

                            $volunteerDates->save();

                        }

                    }
                    
                }
            });
        } catch (\Throwable $th) {
            Log::error($th);
            //throw $th;
            return $this->json(false,'Unable to save your record. Please clear your cache data and re-try.');
        }
        

         /**
          * End of insert
          */

        $this->saveSession('_profile',$request->only('profile_picture','id_card_picture'));
        $confirmation = $this->getSession('_confirmation');

        $view = view($this->plugin_name.'::frontend.registration.partials.confirmation',['confirmation' => $confirmation])->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);
    }

    public function confirmation() {

    }

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function nextStep() {
        $nextStep = '';

        foreach (self::STEPS as $key => $step) {

            if (session()->get('current_step') != $step) {
                continue;
            }

            $nextStep    = $key;
        }

        if ( $nextStep && (count(self::STEPS) -1 ) == $nextStep) {
            session()->put('current_step','complete');
            return;
        }
        $nextClass = $nextStep+1;
        session()->put('current_step',self::STEPS[$nextClass]);
    }

    /**
     * 
     */
    public function volunteerData(Request $request) {
       $request->validate([
            'confirm_presence' => 'required|accepted',
            'accept_rules_and_regulation' => 'required|accepted',
       ]);

        /**
         * Update this information in member table.
         */
        $member = $this->getSession('_personalInfo') ?? $this->getSession('_personal');

        if ( ! $member ) {
            return $this->json(false,'Invalid Request.',null);
        }

       

       $this->saveSession('_volunteerData',$request->only(['confirm_presence','accept_rules_and_regulation','dateCheckBox']));
       
        $profile = $this->getSession('_profile');
        $view = view($this->plugin_name.'::frontend.registration.partials.profile',['profile' => $profile])->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);

    }

 
    public function stepBack(Request $request) {

        $request->validate(['back' => 'required|in:volunteerData,volunteerParticipation,personal']);

        $view = view($this->plugin_name.'::'.'frontend.registration.partials.'.$request->post('back'),['previous' => null])->render();
        return $this->json(true,'Data updated',null,['view' => $view]);
    }

    public function volunteerInterest() {
        $this->nextStep();

        $view = view($this->plugin_name.'::frontend.registration.partials.'.session()->get('current_step'))->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);
    }

    /**
     * Save session
     */
    public function saveSession(string $keyName, mixed $values=[]) {

        if (  ! session()->has('_volunreerForm') ){
            session()->put('_volunreerForm',[]);
        }

        $sessionValue = session()->get('_volunreerForm');

        if (! isset($sessionValue[$keyName]) ) {
            $sessionValue[$keyName] = [];
        }

        $sessionValue[$keyName] = $values;

        session()->put('_volunreerForm',$sessionValue);

    }

    /**
     * Get Session Value
     */
    public function getSession(string $keyName, string|null$indexName=null) : mixed {

        $sessionValue = session()->get('_volunreerForm');

        if (  ! $sessionValue ) {
            return null;
        }

        if ( ! isset ($sessionValue[$keyName]) ) {
            return null;
        }

        if ($indexName &&  ! isset ($sessionValue[$keyName][$indexName])) {
            return null;
        }

        if ($indexName && isset($sessionValue[$keyName][$indexName]) ) {
            return $sessionValue[$keyName][$indexName];
        }

        return $sessionValue[$keyName];

    }
}