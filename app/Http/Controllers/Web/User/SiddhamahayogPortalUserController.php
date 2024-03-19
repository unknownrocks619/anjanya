<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Portal\HanumandYagyaCounter;
use App\Models\Portal\HanumandYagyaDailyCounter;
use App\Models\Portal\MemberDikshya;
use App\Models\Portal\MemberEmergencyMeta;
use App\Models\Portal\MemberInfo;
use App\Models\Portal\MemberJapInformation;
use App\Models\Portal\PortalCountry;
use App\Models\Portal\ProgramUser;
use App\Models\Portal\UserModel;
use App\Models\User;
use App\Rules\Unicode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class SiddhamahayogPortalUserController extends Controller
{
    protected  $memberRegistration;
    /**
     * Validate Email Address in
     * Siddhamahayog and return response accordingly.
     * @param Request $request
     * @return
     */
    public function userResponse(Request $request): array {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = UserModel::with(['diskshya','meta','emergency'])->where('email', $request->post('email'))->first();

        if ( ! $user ) {

            $userModel = new UserModel();
            $userModel->setTable('program_users')->setConnection('ramarchan_connection');
            // check in ramrachan connection
            $user = $userModel->where('email',$request->post('email'))
                                ->first();

        }

        $returnArray = [];

        if ( ! $user ) {
            return $returnArray;
        }

        if ($user->getConnection()->getName() == 'portal_connection') {

            // check if user has already submitted.

            $hasSubmitted = MemberJapInformation::where('member_id', $user->getKey())->first();

            $address = ! ($user->address) ? '' : $user->address->street_address;
            $country_label = '';
            if ($user->country && is_int($user->country)) {
                $country_label = (PortalCountry::where('id', $user->country)->first())?->name;
            }
            $returnArray = [
                'required_password' => true,
                'has_submitted' => $hasSubmitted ? true : false,
                'password'  => false,
                'validated' => false,
                'has_password'  => true,
                'full_name' => $user->full_name,
                'first_name'    => $user->first_name,
                'middle_name'   => $user->middle_name,
                'last_name'     => $user->last_name,
                'gotra'         => $user->gotra,
                'gender'        => $user->gender,
                'country'       => $user->country,
                'country_label' => $country_label,
                'city'          => $user->city,
                'street_address'    => $address,
                'phone_number'  => $user->phone_number,
                'date_of_birth' => $user->date_of_birth,
                'profile_url'   => ($user->profile && isset($user->profile->full_path)) ? $user->profile->full_path : '',
                'reference_source' => '',
                'referer_name' => '',
                'referer_relation' => '',
                'reference_source_detail' => '',
                'meta'  => [],
                'dikshya'   => [],
                'emergency' => [],
                'userID'    => $user?->getKey()
            ];

            if ( $user->meta ) {
                $returnArray['meta'] = [
                    'history' => $user->meta->history ?  (array) $user->meta->history : [],
                    'education'  => $user->meta->education ? (array) $user->meta->education : [],
                    'personal' => $user->meta->personal ? (array) $user->meta->personal : []
                ];
            }

            if ( $user->emergency) {

                $returnArray['emergency'] = [
                    'full_name' => $user->emergency->contact_person,
                    'relation'  => $user->emergency->relation,
                    'phone_number'  => $user->emergency->phone_number
                ];
            }

            if ( $user->diskshya->count() ) {

                foreach ($user->diskshya as $dikshya) {
                    $returnArray['dikshya'][] = [
                        'guru_name' => $dikshya->guru_name,
                        'dikshya_type'  => $dikshya->dikshya_type,
                        'dikshya_date'  => $dikshya->ceromony_date,
                        'remarks'   => $dikshya->remarks,
                        'ceromony_location' => $dikshya->ceromony_location
                    ];
                }
            }
        }

        if ($user->getConnection()->getName() == 'ramarchan_connection') {

            $name_explode = explode(' ' , $user->full_name);
            $first_name = $name_explode[0];
            $middle_name = '';
            $last_name = '';
            unset($name_explode[0]);


            if ( isset ($name_explode[2]) ) {
                $middle_name = $name_explode[1];
                unset($name_explode[1]);
            }

            $last_name = implode(' ', $name_explode);

            $returnArray = [
                'has_password' => false,
                'password'  => false,
                'validated' => false,
                'full_name' => $user->full_name,
                'first_name'    => $first_name,
                'middle_name'   => $middle_name,
                'last_name'     => $last_name,
                'gender'        => $user->gender,
                'gotra'         => $user && isset($user->alias_name->family_cast) ? $user->alias_name->family_cast  : '',
                'reference_source' => '',
                'referer_name' => '',
                'referer_relation' => '',
                'reference_source_detail' => '',

                'country'       => '',
                'country_label' => '',
                'city'          => '',
                'street_address'       => '',
                'phone_number'  => $user->phone_number,
                'date_of_birth' => $user->date_of_birth,
                'meta'  => [],
                'dikshya'   => [],
                'emergency' => [],
            ];
        }

        return $returnArray;

    }

    public function storeEventDetail() {
        try {
            DB::transaction(function() {


                $sessionUserDetail = session()->get('registration_detail');

                if (session()->has('allow_back') && isset ($sessionUserDetail['userID']) ) {

                    $memberRegistration = UserModel::where('id',$sessionUserDetail['userID'])->first();
                    $memberRegistration->profile = ['full_path' => $sessionUserDetail['profile_url'],'id_card' => $sessionUserDetail['profile_id']];
                    $memberRegistration->save();
                    $this->memberRegistration = $memberRegistration;
                    return $memberRegistration;
                }

                // check if we need to create new user
                if (session()->has('new_registration') && session()->get('new_registration') == true && UserModel::where('email',session()->get('registration-email'))->exists() === false) {

                    $memberRegistration = new UserModel();
                    $memberRegistration->fill([
                        'full_name' => $sessionUserDetail['full_name'],
                        'first_name'    => $sessionUserDetail['first_name'],
                        'middle_name'   => $sessionUserDetail['middle_name'],
                        'last_name'     => $sessionUserDetail['last_name'],
                        'gotra'         => $sessionUserDetail['gotra'],
                        'source'        => 'Website - Hanumant Yagya Form',
                        'profile'       => ['full_path' => $sessionUserDetail['profile_url'],'id_card' => $sessionUserDetail['profile_id']],
                        'gender'        => $sessionUserDetail['gender'],
                        'country'       => $sessionUserDetail['country'],
                        'city'          => $sessionUserDetail['city'],
                        'address'       => ['street_address' => $sessionUserDetail['street_address']],
                        'date_of_birth' => $sessionUserDetail['date_of_birth'],
                        'email'         => session()->get('registration-email'),
                        'phone_number'  => $sessionUserDetail['phone_number'],
                        'is_email_verified' => false,
                        'is_phone_verified' => false,
                        'sharing_code'  => rand(11111111,9999999999),
                    ]);
                    $memberRegistration->password = $sessionUserDetail['user_password'];
                    $memberRegistration->role_id = 7;
                    $memberRegistration->save();
                } else {
                    $memberRegistration = UserModel::where('email',session()->get('registration-email'))->first();
                    $memberRegistration->fill([
                        'full_name' => $sessionUserDetail['full_name'],
                        'first_name'    => $sessionUserDetail['first_name'],
                        'middle_name'   => $sessionUserDetail['middle_name'],
                        'last_name'     => $sessionUserDetail['last_name'],
                        'gotra'         => $sessionUserDetail['gotra'],
                        'profile'       => ['full_path' => $sessionUserDetail['profile_url'],'id_card' => $sessionUserDetail['profile_id']],
                        'gender'        => $sessionUserDetail['gender'],
                        'country'       => $sessionUserDetail['country'],
                        'city'          => $sessionUserDetail['city'],
                        'address'       => ['street_address' => $sessionUserDetail['street_address']],
                        'date_of_birth' => $sessionUserDetail['date_of_birth'],
                        'phone_number'  => $sessionUserDetail['phone_number'],
                    ]);
                    $memberRegistration->save();


                }
                $this->memberRegistration = $memberRegistration;
                // Update meta information
                $meta = MemberInfo::where('member_id', $memberRegistration->getKey())->first();

                if (! $meta ) {

                    $meta = new MemberInfo();
                    $meta->fill(['member_id' => $memberRegistration->getKey()]);
                }

                $meta->personal = $sessionUserDetail['meta']['personal'];
                $meta->education = $sessionUserDetail['meta']['education'];
                $meta->total_connected_family = $sessionUserDetail['total_member_with_gurudev'];

                $meta->save();
                // Update Emergency Contact Information

                $emergency = MemberEmergencyMeta::where('member_id', $memberRegistration->getKey())->first();

                if (! $emergency ) {

                    $emergency = new MemberEmergencyMeta();
                    $emergency->member_id = $memberRegistration->getKey();
                }

                $emergency->fill([
                    'contact_person' => $sessionUserDetail['emergency']['full_name'],
                    'relation'  => $sessionUserDetail['emergency']['relation'],
                    'phone_number' => $sessionUserDetail['emergency']['phone_number'],
                ]);

                $emergency->save();
                // update family information,
                $familyInsert = [];

                foreach ($sessionUserDetail['family_detail']['members'] as $family_member) {
                    // create dummy email for family member of this user.
                    $familyInsert[] = [
                        'member_id' => $memberRegistration->getKey(),
                        'contact_person' => $family_member['name'],
                        'relation'  => $family_member['relation'],
                        'phone_number'  => $family_member['phone_number'],
                        'profile' => null,//$family_member['profile'],
                        'contact_type'  => 'family',
                        'gender'    => $family_member['gender'],
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ];
                }

                if ( count ($familyInsert ) ) {
                    MemberEmergencyMeta::insert($familyInsert);
                }

                // jap Information
                $jap = new MemberJapInformation();

                $jap->fill([
                    'member_id' => $memberRegistration->getKey(),
                    'event_id'  => 5,
                    'total_jap_count' => $sessionUserDetail['jap_detail']['total_jap_count'],
                    'jap_start_date' => $sessionUserDetail['jap_detail']['jap_start_date'],
                    'total_expected_jap_count' => $sessionUserDetail['jap_detail']['estimated_jap'],
                    'average_jap_count' => 0,
                    'is_family' => false,
                ]);

                $jap->save();

                // Now Enroll user in Program.

                $batchID = 5;
                $sectionID = 6;
                $programID = 5;
                $studentID = $memberRegistration->getKey();

                if ( ! ProgramUser::where('program_id','=' , $programID)->where('student_id','=',$studentID)->exists()) {

                    $addUserToProgram = new ProgramUser;
                    $addUserToProgram->fill([
                        'program_id' => $programID,
                        'program_section_id' => $sectionID,
                        'student_id' => $studentID,
                        'batch_id'  => $batchID,
                        'active'    => true,
                    ]);

                    $addUserToProgram->save();
                }

                // add Dikshya Information
                $dikshyaInformationSession = $sessionUserDetail['dikshit'];
                if ( $dikshyaInformationSession['type'] == 'dikshit' ) {
                    $dikshyaType = explode('&',$dikshyaInformationSession['category']);

                    foreach ($dikshyaType as $selectedDikshya){

//                        $userDikshay = MemberDikshya::where('member_id',$memberRegistration->getKey())
//                            ->where('dikshya_type',$selectedDikshya)
//                            ->first();

//                        if ( ! $userDikshay ) {

                            $userDikshay = new MemberDikshya();
                            $userDikshay->fill([
                                'member_id' => $memberRegistration->getKey(),
                                'dikshay_type'  => $selectedDikshya,
                                'rashi_name' => '-',
                                'ceromony_location' => '-',
                            ]);

                            $userDikshay->save();
//                        }
                    }
                }

                // Add yagya Counter Information.
                $yagyaInformation = HanumandYagyaCounter::where('member_id',$memberRegistration->getKey())
                                                            ->where('program_id',$programID)
                                                            ->first();

                if (! $yagyaInformation ) {

                    $yagyaInformation = new HanumandYagyaCounter();
                    $yagyaInformation->fill([
                        'member_id' => $memberRegistration->getKey(),
                        'program_id' => $programID,
                        'total_counter' => $sessionUserDetail['jap_detail']['total_jap_count'],
                        'is_taking_part'    => true,
                        'start_date'    => $sessionUserDetail['jap_detail']['jap_start_date'],
                    ]);

                    $yagyaInformation->save();

                }

                // check if the information was not filled today. than fill it.
                $yagyaDailyCounter = HanumandYagyaDailyCounter::where('humand_yagya_id' , $yagyaInformation->getKey())
                                                                ->where('count_date',now()->format('Y-m-d'))
                                                                ->first();
                if ( ! $yagyaDailyCounter ) {
                    $yagyaDailyCounter = new HanumandYagyaDailyCounter();
                    $yagyaDailyCounter->fill([
                        'humand_yagya_id' => $yagyaInformation->getKey(),
                        'member_id' => $memberRegistration->getKey(),
                        'count_date'    => now()->format('Y-m-d'),
                        'total_count'   => $sessionUserDetail['jap_detail']['total_jap_count'],
                    ]);
                    $yagyaDailyCounter->save();
                }

                return $memberRegistration;
            });

        } catch (\Exception $e) {
            Log::error('Unable to save user jap info. '. $e->getMessage(),['HANUMANT YAGYA']);
            return false;
        }
        return $this->memberRegistration;
    }

    public function verifyPassword(Request $request) {
        if ( ! Auth::guard('portal')->attempt(
                        ['email'=> session()->get('registration-email'),
                            'password' => $request->post('password')], false) ) {

            return false;
        }
        return true;
    }

    public function liveProgramEvent(Request $request, string $event='') {
        $request->validate([
            'first_name'    => ['required','string',new Unicode()],
            'last_name' => ['required','string',new Unicode()],
            'email' => ['required','email', new Unicode()],
            'password'  => ['sometimes','required','confirmed',new Unicode()]
        ]);

        // check now get
        $user = UserModel::where('email', $request->post('email'))->first();

        if ( ! $user ) {
            $user = new UserModel();
            $user->fill([
                'first_name' => $request->post('first_name'),
                'last_name' => $request->post('last_name'),
                'email' => $request->post('email'),
                'is_email_verified' => false,
            ]);
            $user->full_name = $user->full_name();
            $user->source = 'Event : ' . $event;
            $user->password  = Hash::make($request->post('password'));
            $user->role_id = 7;
            $user->save();
        }

        $programID = 7;
        $sectionID = 8;
        $batchID = 7;
        // check if user is enrolled
        $programUser = ProgramUser::where('program_id', $programID)
                                    ->where('student_id', $user->getKey())
                                    ->first();

        if ( ! $programUser ) {

            $programUser = new ProgramUser();

            $programUser->fill([
                'student_id' => $user->getKey(),
                'program_id'    => $programID,
                'program_section_id'    => $sectionID,
                'batch_id'  => $batchID,
                'active'    => true
            ]);

            $programUser->save();
        }

        // now send detail to
        return ['user' => $user->getKey(),'program' =>$programID];
    }

    public function createNewAccountForLiveEvent(Request $request) {

    }
}
