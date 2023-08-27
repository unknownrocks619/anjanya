<?php

namespace App\Http\Controllers\Test;

use App\Classes\Components\Component;
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
       $component = new Component('block_builder');
       dd($component->builder());
    }
}
