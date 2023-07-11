<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use ReflectionClass;

class ClearFrontendCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear:frontend {key_name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear frontend cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->argument('key_name')) {
            //Setting Configuration
            Cache::forget(Setting::BASIC_SOCIAL_CONFIGURATION_CACHE_NAME);
            Cache::forget(Setting::BASIC_CONFIGURATION_CACHE_NAME);
            Cache::forget(Setting::SITE_LOGO_CACHE_NAME);
            Cache::forget(Setting::SITE_PRIMARY_CONTACT_CACHE_NAME);
            Cache::forget(Setting::MEMBERSHIP_REGISTRATION_EMAIL_CACHE_NAME);
            Cache::forget(Setting::MEMBERSHIP_REJECTED_CACHE_NAME);
            Cache::forget(Setting::MEMBERSHIP_APPROVED_EMAIL_CACHE_NAE);
            Cache::forget(Setting::USER_WELCOME_EMAIL_CACHE_NAME);
            Cache::forget(Setting::MEMBERSHIP_REGISTRATION_EMAIL_SUBJECT_CACHE_NAME);
            Cache::forget(Setting::MEMBERSHIP_APPROVED_EMAIL_SUBJECT_CACHE_NAE);
            Cache::forget(Setting::MEMBERSHIP_REJECTED_SUBJECT_CACHE_NAME);
            Cache::forget(Setting::USER_WELCOME_EMAIL_SUBJECT_CACHE_NAME);
            Cache::forget(Setting::SITE_FOOTER_PAGE_CACHE_NAME);
            Cache::forget(Setting::SITE_PAGE_SETTING_CACHE_NAME);
            Cache::forget('FOOTER_INSTAGRAM_IMAGE_ARRAY');
            Cache::forget('frontend_menus');
            return;
        }

        $constName = '\App\Models\Setting::' . $this->argument('key_name');
        $settingReflectionClass = new ReflectionClass(new Setting);
        if ($settingReflectionClass->hasConstant('SITE_LOGO_CACHE_NAME')) {
            Cache::forget(constant($constName));
        }
    }
}
