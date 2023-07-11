<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\WP\Users as WPUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ImportWPUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $limit = 5000;
    protected $countries = [];
    protected $roles = [];
    public function __construct()
    {
        //
        $this->roles = [
            'parents-of-student' => 'parent',
            'student-under-18'    => 'student_under',
            'school-teacher'    => 'teacher',
            'subscriber'        => 'subscriber',
            'student-over-18'   => 'student_above'
        ];
        $this->countries = \App\Models\Country::get();
        $this->handle();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        $totalRecord = WPUser::count();
        $totalLoop = floor($totalRecord / $this->limit);
        dump('Total Batch : ' . $totalLoop);
        echo PHP_EOL;
        dump(date("H:i:s"));

        for ($i = 0; $i <=  floor($totalLoop); $i++) {

            dump('Running Batch ' .  $i);
            $offset = ($i == 0) ? $i : ($this->limit * $i) + 1;
            $this->importUser($offset);
        }
    }

    public function importUser($offset)
    {

        $wpUserSQL = "

                        SELECT users.*,
                        meta1.meta_value AS first_name,
                        meta2.meta_value AS last_name,
                        meta3.meta_value AS billing_country,
                        meta4.meta_value AS shipping_country,
                        meta5.meta_value AS wp_capabilities
                        FROM wp_users AS users
                        LEFT JOIN wp_usermeta AS meta1 ON users.ID = meta1.user_id AND meta1.meta_key = 'first_name'
                        LEFT JOIN wp_usermeta AS meta2 ON users.ID = meta2.user_id AND meta2.meta_key = 'last_name'
                        LEFT JOIN wp_usermeta AS meta3 ON users.ID = meta3.user_id AND meta3.meta_key = 'billing_country'
                        LEFT JOIN wp_usermeta AS meta4 ON users.ID = meta4.user_id AND meta4.meta_key = 'shipping_country'
                        LEFT JOIN wp_usermeta AS meta5 ON users.ID = meta5.user_id AND meta5.meta_key = 'wp_capabilities'
                        LIMIT {$this->limit}
                        OFFSET {$offset}
                    ";
        $sqlQuery = <<<SQL
        $wpUserSQL
        SQL;
        $userRecord = DB::connection('wpmysql')->select($sqlQuery);
        $chunkRecord = [];
        foreach ($userRecord as $wpUser) {

            if (!$wpUser->wp_capabilities) {
                echo 'User Role not found. ' . PHP_EOL;
                continue;
            }
            $wpUserRole = unserialize(str_replace("'", '"', $wpUser->wp_capabilities));
            $userRole = null;
            foreach ($wpUserRole as $rolekey => $value) {
                if (array_key_exists($rolekey, $this->roles)) {
                    $userRole = $this->roles[$rolekey];
                }
            }

            if (!Validator::make(['email' => $wpUser->user_email], ['email' => 'required|email'])->passes()) {
                echo 'Invalid user email in WpID ' . $wpUser->ID . PHP_EOL;
            }


            if (!$userRole || empty(trim($wpUser->user_email))) {
                echo 'Skipping for user role in wpID: ' . $wpUser->ID . PHP_EOL;
                continue;
            }

            $innerArray = [
                'email' => $wpUser->user_email,
                'username'  => $wpUser->user_login ?? \Illuminate\Support\Str::random(10),
                'password'  => $wpUser->user_pass,
                'created_at'    => $wpUser->user_registered,
                'source'    => 'wp_import',
                'invite_token' => strtoupper(\Illuminate\Support\Str::random(12)),
                'status'    => 'active',
                'current_step'  => 'complete',
                'terms' => true,
                'role'  => $userRole,
                'first_name'    => $wpUser->first_name,
                'last_name' => $wpUser->last_name,
                'country'   => null

            ];

            if ($wpUser->billing_country) {
                $currentDBCountry = $this->countries->where('code', $wpUser->billing_country)->first();
                $innerArray['country'] = $currentDBCountry?->getKey();
            }
            $chunkRecord[] = $innerArray;
        }

        DB::connection('mysql')->table('users')->insertOrIgnore($chunkRecord);
        dump('Batch Complete in  : ' . date("H:i:s"));
    }
}
