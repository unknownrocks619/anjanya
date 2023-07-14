<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Database\Seeders\SystemSettingInstagramConfiguration;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Sabberworm\CSS\Settings;

class SettingController extends Controller
{
    //
    public function index()
    {
        if (request()->ajax() && request()->method() === 'POST') {
            ((new SystemSettingInstagramConfiguration())->social_instagram_footer_images());
            Artisan::call('cache:clear');
            return $this->json(true, 'Configuration Setting Saved.', 'reload');
        }

        return $this->admin_theme('settings.index');
    }

    public function store(Request $request)
    {
    }

    public function basic_configuration(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'tagline'   => 'required',
            'host'      => 'required',
            'email_official'    => 'required',
        ]);


        $settingsValue = [];

        foreach (Setting::BASIC_CONFIGURATION as $key => $value) {
            $innerArray = [
                'name'  => $key,
                'value' => $request->post($key),
            ];
            $settingsValue[] = $innerArray;
        }

        try {
            DB::transaction(function () use ($settingsValue) {
                /**
                 * Delete previous record.
                 */
                Setting::whereIn('name', array_keys(Setting::BASIC_CONFIGURATION))->delete();
                Setting::insert($settingsValue);
            });
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update settings configuration.');
        }
        $this->social_configuration($request);
        Artisan::call('cache:clear:frontend');
        return $this->json(true, 'Basic setting updated.');
    }

    public function social_configuration(Request $request)
    {

        $settings = [];
        $toDeleteKeys = [];
        foreach (Setting::SOCIAL_CONFIURATION as $key => $value) {
            if (!$request->has($key)) {
                continue;
            }
            $toDeleteKeys[] = $key;

            $innerArray = [
                'name' => $key,
                'value' => $request->post($key)
            ];
            $settings[] = $innerArray;
        }

        try {
            DB::transaction(function () use ($settings, $toDeleteKeys) {
                Setting::whereIn('name', $toDeleteKeys)->delete();
                Setting::insert($settings);
            });
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update social media info');
        }
        return $this->json(true, 'Social Media info update.', 'reload');
    }

    public function logo_configuration(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $settingLogo = Setting::where('name', 'company_logo')->first();

                if (!$settingLogo) {
                    $settingLogo = new Setting;
                    $settingLogo->fill([
                        'name'  => 'company_logo',
                        'value' => ''
                    ]);
                    $settingLogo->save();
                }

                $image = Image::uploadOnly($request->file('file'));
                $settingLogo->value = Image::getImageAsSize($image[0]->filepath, 'm');
                $settingLogo->save();
            });
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to upload media');
        }
        Artisan::call('cache:clear:frontend ' . 'SITE_LOGO_CACHE_NAME');
        return $this->json(true, 'File uploaded.', 'reload');
    }

    public function primary_contact_configuration(Request $request)
    {
        $primaryAddress = [];
        foreach (Setting::PRIMARY_ADDRESS as $key => $value) {
            if (!$request->has($key) || !$request->post($key)) {
                continue;
            }
            $innerArray = [
                'name'  => $key,
                'value' => $request->post($key)
            ];
            $primaryAddress[] = $innerArray;
        }

        try {
            DB::transaction(function ()  use ($primaryAddress) {
                Setting::whereIn('name', array_keys(Setting::PRIMARY_ADDRESS))->delete();
                Setting::insert($primaryAddress);
            });
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update primary contact.');
        }
        Artisan::call('cache:clear:frontend SITE_PRIMARY_CONTACT_CACHE_NAME');
        return $this->json(true, 'Primary Contact Updated.');
    }

    public function welcome_email_text(Request $request)
    {
        $welcomeSettings = Setting::where('name', 'welcome_email_text')->first();
        $welcomeSubjectSettings = Setting::where('name', 'welcome_email_subject')->first();
        if (!$welcomeSettings) {
            $welcomeSettings = new Setting;
            $welcomeSettings->fill([
                'name'  => 'welcome_email_text',
            ]);
        }

        if (!$welcomeSubjectSettings) {
            $welcomeSubjectSettings = new Setting;
            $welcomeSubjectSettings->fill([
                'name' => 'welcome_email_subject'
            ]);
        }
        $welcomeSubjectSettings->value = $request->post('welcome_email_subject');
        $welcomeSettings->value  = $request->post('welcome_email_text');

        try {
            $welcomeSubjectSettings->save();
            $welcomeSettings->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update email setting.');
        }
        Artisan::call('cache:clear:frontend USER_WELCOME_EMAIL_SUBJECT_CACHE_NAME');
        Artisan::call('cache:clear:frontend USER_WELCOME_EMAIL_CACHE_NAME');
        return $this->json(true, 'Welcome Email Setting update.');
    }

    public function welcome_membership_text(Request $request)
    {
        $welcomeSettings = Setting::where('name', 'user_membership_registration_text')->first();
        $membershipRegistrationSubject = Setting::where('name', 'user_membership_registration_subject')->first();

        if (!$welcomeSettings) {
            $welcomeSettings = new Setting;
            $welcomeSettings->fill([
                'name'  => 'user_membership_registration_text',
            ]);
        }

        if (!$membershipRegistrationSubject) {
            $membershipRegistrationSubject = new Setting;
            $membershipRegistrationSubject->fill([
                'name'  => 'user_membership_registration_subject'
            ]);
        }

        $membershipRegistrationSubject->value = $request->post('user_membership_registration_subject');
        $welcomeSettings->value  = $request->post('user_membership_registration_text');

        try {
            $membershipRegistrationSubject->save();
            $welcomeSettings->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update email setting.');
        }

        Artisan::call('cache:clear:frontend MEMBERSHIP_REGISTRATION_EMAIL_SUBJECT_CACHE_NAME');
        Artisan::call('cache:clear:frontend MEMBERSHIP_REGISTRATION_EMAIL_CACHE_NAME');
        return $this->json(true, 'Email Setting update.');
    }

    public function membership_approved_text(Request $request)
    {
        $welcomeSettings = Setting::where('name', 'user_membership_approved_text')->first();
        $membershipApprovedSubject = Setting::where('name', 'user_membership_approved_subject')->first();

        if (!$welcomeSettings) {
            $welcomeSettings = new Setting;
            $welcomeSettings->fill([
                'name'  => 'user_membership_approved_text',
            ]);
        }

        if (!$membershipApprovedSubject) {
            $membershipApprovedSubject = new Setting;
            $membershipApprovedSubject->fill([
                'name'  => 'user_membership_approved_subject'
            ]);
        }

        $welcomeSettings->value  = $request->post('user_membership_approved_text');
        $membershipApprovedSubject->value = $request->post('user_membership_approved_subject');

        try {
            $welcomeSettings->save();
            $membershipApprovedSubject->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update email setting.');
        }

        Artisan::call('cache:clear:frontend MEMBERSHIP_APPROVED_EMAIL_SUBJECT_CACHE_NAE');
        Artisan::call('cache:clear:frontend MEMBERSHIP_APPROVED_EMAIL_CACHE_NAE');

        return $this->json(true, 'Email Setting update.');
    }

    public function membership_rejected_text(Request $request)
    {
        $welcomeSettings = Setting::where('name', 'user_membership_rejected_text')->first();
        $membershipRejectSubjet = Setting::where('name', 'user_membership_rejected_subject')->first();

        if (!$welcomeSettings) {
            $welcomeSettings = new Setting;
            $welcomeSettings->fill([
                'name'  => 'user_membership_rejected_text',
            ]);
        }

        if (!$membershipRejectSubjet) {
            $membershipRejectSubjet = new Setting;
            $membershipRejectSubjet->fill([
                'name'  => 'user_membership_rejected_subject'
            ]);
        }

        $welcomeSettings->value  = $request->post('user_membership_rejected_text');
        $membershipRejectSubjet->value = $request->post('user_membership_rejected_subject');

        try {
            $welcomeSettings->save();
            $membershipRejectSubjet->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update email setting.');
        }

        Artisan::call('cache:clear:frontend MEMBERSHIP_REJECTED_SUBJECT_CACHE_NAME');
        Artisan::call('cache:clear:frontend MEMBERSHIP_REJECTED_CACHE_NAME');
        return $this->json(true, 'Email Setting update.');
    }


    public function footer()
    {
        if (request()->ajax() && request()->method() === 'POST') {
            ((new SystemSettingInstagramConfiguration())->social_instagram_footer_images());
            Artisan::call('cache:clear:frontend');
            return $this->json(true, 'Configuration Setting Saved.', 'reload');
        }
        $instagramSettings = \App\Classes\Helpers\SystemSetting::social_media('social_instagram');
        return $this->admin_theme('settings.footer', ['footerInstagramSetting' => $instagramSettings]);
    }

    public function page_setting(Request $request, $current_tab = 'general')
    {
        $settings = ['home_page_setting', 'category_page_setting', 'about_us_setting'];
        $settingsModels = Setting::whereIn('name', $settings)->with('getComponents')->get();

        if ($request->ajax() && $request->method() === "POST") {
            if ($request->has('configuration')) {
                ((new SystemSettingInstagramConfiguration())->social_instagram_footer_images());
            }

            if ($request->has('setting')) {

                $currentSettings = $settingsModels->where('id', $request->get('setting'))->first();
                $sidebarSetting = !$currentSettings->additional_text['sidebar'];
                $currentSettings->additional_text = ['sidebar' => $sidebarSetting, 'blocks' => $currentSettings->additional_text['blocks']];
                $currentSettings->save();
            }

            if ($request->has('type')) {
                $currentSettings = $settingsModels->where('id', $request->post('setting_id'))->first();
                $blocks = [];
                foreach ($request->post('status') as $key => $value) {
                    if (!$value) {
                        continue;
                    }
                    $blocks[$request->post('position')[$key]] = $request->post('name')[$key];
                }
                $currentSettings->additional_text = ['sidebar' => $currentSettings->additional_text['sidebar'], 'blocks' => $blocks];
                $currentSettings->save();
            }

            Artisan::call('cache:clear:frontend SITE_PAGE_SETTING_CACHE_NAME');
            return $this->json(true, 'Configuration Setting Saved.', 'reload');
        }


        $configs = $settingsModels->count() ? $settingsModels : null;

        $homePageSetting = $settingsModels?->where('name', 'home_page_setting')->first();
        $categoryPageSetting = $settingsModels?->where('name', 'category_page_setting')->first();
        $aboutPageSetting = $settingsModels?->where('name', 'about_us_setting')->first();

        return $this->admin_theme('settings.page', [
            'configs' => $configs,
            'home_page' => $homePageSetting,
            'category_page' => $categoryPageSetting,
            'about_page'    => $aboutPageSetting,
            'current_tab'   => $current_tab
        ]);
    }

    public function delete()
    {
    }
}
