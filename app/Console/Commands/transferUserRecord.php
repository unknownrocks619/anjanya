<?php

namespace App\Console\Commands;

use App\Models\Portal\MemberDikshya;
use App\Models\Portal\MemberEmergencyMeta;
use App\Models\Portal\MemberInfo;
use App\Models\Portal\ProgramUser;
use App\Models\Portal\UserModel;
use App\Models\SuccessRecords;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class transferUserRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $successEntryRecords = SuccessRecords::whereNotNull('id_event')->where('id_event', 4)->get();
        $skipUser = [];

        foreach ($successEntryRecords as $successRecord) {
            $sessionRecord = $successRecord->session_info;
            $userDetail = null;
            if (isset($sessionRecord['userID'])) {
                $userDetail = UserModel::find($sessionRecord['userID']);
                if ($userDetail) {
                    echo 'Updating User ' . $userDetail->getKey() . PHP_EOL;

                    $this->updateOldUser($userDetail);
                    continue;
                }
            }

            if (! $userDetail) {

                $userDetail = UserModel::where('email', $sessionRecord['email'])->first();
                if ($userDetail) {
                    echo 'Updating User ' . $sessionRecord['email'] . PHP_EOL;;
                    $this->updateOldUser($userDetail);
                    continue;
                }
            }

            $userDetail = new UserModel();
            echo 'Processing User ' . $sessionRecord['email'];
            $userDetail->fill($sessionRecord);

            if ($sessionRecord['new_user'] == true && $sessionRecord['validated'] == false) {
                $skipUser[] = $sessionRecord['email'];
                continue;
            }
            if (! isset($sessionRecord['user_password'])) {
                $skipUser[] = $sessionRecord['email'];
                continue;
            }
            $userDetail->password = $sessionRecord['user_password'];
            $userDetail->source = $sessionRecord['reference_source'];

            $userDetail->address = [
                'street_address'    => $sessionRecord['street_address'],
            ];
            $userDetail->role_id = 7;
            $userDetail->save();
            $this->updateOldUser($userDetail);
            /**
             * User Meta Information
             */
            $memberInfo = new MemberInfo();

            $memberInfo->fill([
                'personal'  => $sessionRecord['meta']['personal'] ?? '',
                'education' => $sessionRecord['meta']['education'] ?? '',
                'member_id' => $userDetail->getKey()
            ]);

            /**
             * Emergency Contact
             */

            $emergency = new MemberEmergencyMeta();
            $emergency->member_id = $userDetail->getKey();
            $emergency->fill($sessionRecord['emergency']);
            $emergency->contact_person = $sessionRecord['emergency']['full_name'];
            $emergency->contact_type = 'emergency';
            $emergency->save();

            if (isset($sessionRecord['dikshit']['type']) && $sessionRecord['dikshit']['type'] != 'non-dikshit') {
                $userDikshay = new MemberDikshya();
                $userDikshay->fill([
                    'member_id' => $userDetail->getKey(),
                    'dikshay_type'  => $sessionRecord['dikshit']['category'],
                    'rashi_name' => '-',
                    'ceromony_location' => '-',
                ]);

                $userDikshay->save();
            }
        }
    }

    public function updateOldUser(UserModel $user)
    {
        $programStudent = ProgramUser::where('program_id', 9)
            ->where('student_id', $user->getKey())
            ->first();
        if ($programStudent) {
            return;
        }

        $programStudent = new ProgramUser();
        $programStudent->fill([
            'program_id' => 9,
            'program_section_id' => 10,
            'student_id'    => $user->getKey(),
            'batch_id'  => 7,
            'active'    => 1,
        ]);

        try {
            //code...
            $programStudent->save();
        } catch (\Throwable $th) {
            //throw $th;
            Log::log('error', 'failed to transfer user: '. $th->getMessage(),$programStudent?->toArray());
            dd($th->getMessage(), $user);
        }
    }
}
