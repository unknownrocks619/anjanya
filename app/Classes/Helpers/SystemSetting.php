<?php

namespace App\Classes\Helpers;

use App\Classes\Helpers\Image;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SystemSetting
{


    public static function basic_configuration($setting_name = null)
    {
        if (!Cache::has(Setting::BASIC_CONFIGURATION_CACHE_NAME)) {
            $basicConfigurationSettings = Setting::whereIn('name', array_keys(Setting::BASIC_CONFIGURATION))->get();
            Cache::put(Setting::BASIC_CONFIGURATION_CACHE_NAME, $basicConfigurationSettings);
        } else {
            $basicConfigurationSettings = Cache::get(Setting::BASIC_CONFIGURATION_CACHE_NAME);
        }

        if ($setting_name) {
            $basicConfigurationSettings = $basicConfigurationSettings->where('name', $setting_name)->first();
            return $basicConfigurationSettings?->value;
        }
        return $basicConfigurationSettings;
    }


    public static function social_media($setting_name = null)
    {
        if (!Cache::has(Setting::BASIC_SOCIAL_CONFIGURATION_CACHE_NAME)) {
            $basicSocialConfiguration = Setting::whereIn('name', array_keys(Setting::SOCIAL_CONFIURATION))->get();
            Cache::put(Setting::BASIC_SOCIAL_CONFIGURATION_CACHE_NAME, $basicSocialConfiguration);
        } else {
            $basicSocialConfiguration = Cache::get(Setting::BASIC_SOCIAL_CONFIGURATION_CACHE_NAME);
        }

        if ($setting_name) {
            $basicSocialConfiguration = $basicSocialConfiguration->where('name', $setting_name)->first();
            return $basicSocialConfiguration?->value;
        }
        return $basicSocialConfiguration;
    }

    public static function primary_contact_info($setting_name = null)
    {
        if (!Cache::has(Setting::SITE_PRIMARY_CONTACT_CACHE_NAME)) {
            $primaryContactAddress = Setting::whereIn('name', array_keys(Setting::PRIMARY_ADDRESS))->get();
            Cache::put(Setting::SITE_PRIMARY_CONTACT_CACHE_NAME, $primaryContactAddress);
        } else {
            $primaryContactAddress = Cache::get(Setting::SITE_PRIMARY_CONTACT_CACHE_NAME);
        }

        if ($setting_name) {
            $primaryContactAddress = $primaryContactAddress->where('name', $setting_name)->first();
            return $primaryContactAddress?->value;
        }
        return $primaryContactAddress;
    }

    /**
     * Welcome
     */
    public static function welcomeEmail($column_name = null)
    {
        if (!Cache::has(Setting::USER_WELCOME_EMAIL_CACHE_NAME)) {
            $welcomeEmail = Setting::where('name', 'welcome_email_text')->first();
            Cache::put(Setting::USER_WELCOME_EMAIL_CACHE_NAME, $welcomeEmail);
        } else {
            $welcomeEmail = Cache::get(Setting::USER_WELCOME_EMAIL_CACHE_NAME);
        }
        if ($column_name) {
            return $welcomeEmail?->$column_name;
        }
        return $welcomeEmail;
    }

    public static function welcomeEmailSubject($column_name = null)
    {
        if (!Cache::has(Setting::USER_WELCOME_EMAIL_SUBJECT_CACHE_NAME)) {
            $welcomeEmailSubject = Setting::where('name', 'welcome_email_subject')->first();
            Cache::put(Setting::USER_WELCOME_EMAIL_SUBJECT_CACHE_NAME, $welcomeEmailSubject);
        } else {
            $welcomeEmailSubject = Cache::get(Setting::USER_WELCOME_EMAIL_SUBJECT_CACHE_NAME);
        }
        if ($column_name) {
            return $welcomeEmailSubject?->$column_name;
        }
        return $welcomeEmailSubject;
    }


    /**
     * Member registration email
     */
    public static function member_registration_email($column_name = null)
    {
        if (!Cache::has(Setting::MEMBERSHIP_REGISTRATION_EMAIL_CACHE_NAME)) {
            $welcomeEmail = Setting::where('name', 'user_membership_registration_text')->first();
            Cache::put(Setting::MEMBERSHIP_REGISTRATION_EMAIL_CACHE_NAME, $welcomeEmail);
        } else {
            $welcomeEmail = Cache::get(Setting::MEMBERSHIP_REGISTRATION_EMAIL_CACHE_NAME);
        }
        if ($column_name) {
            return $welcomeEmail?->$column_name;
        }
        return $welcomeEmail;
    }

    public static function member_registration_email_subject($column_name = null)
    {
        if (!Cache::has(Setting::MEMBERSHIP_REGISTRATION_EMAIL_SUBJECT_CACHE_NAME)) {
            $member_registration_email_subject = Setting::where('name', 'user_membership_registration_subject')->first();
            Cache::put(Setting::MEMBERSHIP_REGISTRATION_EMAIL_SUBJECT_CACHE_NAME, $member_registration_email_subject);
        } else {
            $member_registration_email_subject = Cache::get(Setting::MEMBERSHIP_REGISTRATION_EMAIL_SUBJECT_CACHE_NAME);
        }
        if ($column_name) {
            return $member_registration_email_subject?->$column_name;
        }
        return $member_registration_email_subject;
    }


    /**
     * Registration Approved
     */
    public static function member_registration_approved_email($column_name = null)
    {
        if (!Cache::has(Setting::MEMBERSHIP_APPROVED_EMAIL_CACHE_NAE)) {
            $welcomeEmail = Setting::where('name', 'user_membership_approved_text')->first();
            Cache::put(Setting::MEMBERSHIP_APPROVED_EMAIL_CACHE_NAE, $welcomeEmail);
        } else {
            $welcomeEmail = Cache::get(Setting::MEMBERSHIP_APPROVED_EMAIL_CACHE_NAE);
        }
        if ($column_name) {
            return $welcomeEmail?->$column_name;
        }
        return $welcomeEmail;
    }

    public static function member_registration_approved_email_subject($column_name = null)
    {
        if (!Cache::has(Setting::MEMBERSHIP_APPROVED_EMAIL_SUBJECT_CACHE_NAE)) {
            $welcomeEmail = Setting::where('name', 'user_membership_approved_subject')->first();
            Cache::put(Setting::MEMBERSHIP_APPROVED_EMAIL_SUBJECT_CACHE_NAE, $welcomeEmail);
        } else {
            $welcomeEmail = Cache::get(Setting::MEMBERSHIP_APPROVED_EMAIL_SUBJECT_CACHE_NAE);
        }
        if ($column_name) {
            return $welcomeEmail?->$column_name;
        }
        return $welcomeEmail;
    }


    /**
     * Registration Rejected
     */
    public static function member_registration_rejected_email($column_name = null)
    {
        if (!Cache::has(Setting::MEMBERSHIP_REJECTED_CACHE_NAME)) {
            $welcomeEmail = Setting::where('name', 'user_membership_rejected_text')->first();
            Cache::put(Setting::MEMBERSHIP_REJECTED_CACHE_NAME, $welcomeEmail);
        } else {
            $welcomeEmail = Cache::get(Setting::MEMBERSHIP_REJECTED_CACHE_NAME);
        }
        if ($column_name) {
            return $welcomeEmail?->$column_name;
        }
        return $welcomeEmail;
    }

    public static function member_registration_rejected_subject($column_name = null)
    {
        if (!Cache::has(Setting::MEMBERSHIP_REJECTED_SUBJECT_CACHE_NAME)) {
            $welcomeEmail = Setting::where('name', 'user_membership_rejected_subject')->first();
            Cache::put(Setting::MEMBERSHIP_REJECTED_SUBJECT_CACHE_NAME, $welcomeEmail);
        } else {
            $welcomeEmail = Cache::get(Setting::MEMBERSHIP_REJECTED_SUBJECT_CACHE_NAME);
        }
        if ($column_name) {
            return $welcomeEmail?->$column_name;
        }
        return $welcomeEmail;
    }

    public static function logo()
    {
        if (!Cache::has(Setting::SITE_LOGO_CACHE_NAME)) {
            $companyLogo = Setting::where('name', 'company_logo')->first();
            Cache::put(Setting::SITE_LOGO_CACHE_NAME, $companyLogo);
        } else {
            $companyLogo = Cache::get(Setting::SITE_LOGO_CACHE_NAME);
        }
        return $companyLogo?->value;
    }

    public static function preloader()
    {
        return;
    }

    public static function PageConfiguration()
    {
    }

    public static function footerConfiguration()
    {
        if (Cache::has('FOOTER_INSTAGRAM_IMAGE_ARRAY')) {
            return Cache::get('FOOTER_INSTAGRAM_IMAGE_ARRAY');
        }
        $footerSettingConfiguration = Setting::where('name', 'social_instagram_footer_images')->with(['getImage' => function ($query) {
            $query->with(['image']);
        }])->first();

        $galleries = [];
        if ($footerSettingConfiguration->getImage->count()) {
            foreach ($footerSettingConfiguration->getImage as $imageRelation) {
                $galleries[] = Image::getImageAsSize($imageRelation->image->filepath, 'm');
            }
        }
        Cache::put('FOOTER_INSTAGRAM_IMAGE_ARRAY', $galleries);
        return $galleries;
    }

    public static function pageSetting($setting_name)
    {
        $settings = ['home_page_setting', 'category_page_setting', 'about_us_setting'];

        if (!Cache::has(Setting::SITE_PAGE_SETTING_CACHE_NAME)) {
            $basicConfigurationSettings = Setting::whereIn('name', $settings)->get();
            Cache::put(Setting::SITE_PAGE_SETTING_CACHE_NAME, $basicConfigurationSettings);
        } else {
            $basicConfigurationSettings = Cache::get(Setting::SITE_PAGE_SETTING_CACHE_NAME);
        }
        return $basicConfigurationSettings;
    }

    public static function total_readtime(string $article) {

        // Assuming an average reading speed of 200 words per minute
        $wordsPerMinute = 200;

        // Count the number of words in the content
        $wordCount = str_word_count(strip_tags($article));

        // Calculate the read time in minutes
        $readTimeMinutes = ceil($wordCount / $wordsPerMinute);

        return $readTimeMinutes;
    }
}
