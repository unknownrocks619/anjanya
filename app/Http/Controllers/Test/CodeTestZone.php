<?php

namespace App\Http\Controllers\Test;

use App\Classes\Helpers\SystemSetting;
use App\Http\Controllers\Controller;
use App\Jobs\ImportWPUsers;
use App\Jobs\MembershipRegistrationWelcomeJob;
use App\Mail\Frontend\User\Membership\WelcomeMail;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class CodeTestZone extends Controller
{
    //
    public function index()
    {
        $user = User::find(15);
        MembershipRegistrationWelcomeJob::dispatch($user);
        // $content = SystemSetting::member_registration_email('value');
        // if (str_contains($content, '[full_name]')) {
        //     $content = str_replace('[full_name]', 'Binod Giri', $content);
        //     $content = str_replace(['[first_name]', '[last_name]'], ['', ''], $content);
        // }

        // if (str_contains($content, '[first_name]')) {
        //     $content = str_replace('[first_name]', 'Binod', $content);
        // }

        // if (str_contains($content, '[last_name]')) {
        //     $content = str_replace('[last_name]', 'Giri', $content);
        // }

        // if (str_contains($content, '[date]')) {
        //     $content = str_replace('[date]', date("Y-m-d"), $content);
        // }
        // if (str_contains($content, '[company_name]')) {
        //     $content = str_replace('[company]', SystemSetting::basic_configuration('site_name'), $content);
        // }
        // if (str_contains($content, '[company_logo]')) {
        //     $logo = SystemSetting::logo();
        //     $img = '';
        //     if ($logo) {
        //         $logo = base64_encode(file_get_contents($logo));
        //         $img = "<img src='data:image/jpeg;base64," . $img . "' alt='logo' style='width:35px;height:35px;' />";
        //     }
        //     $content = str_replace('[company_logo]', $img, $content);
        // }

    }
}
