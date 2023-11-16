<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HeaderController extends Controller
{
    protected array $configs = [];

    public function themeSettings() {
        $request = Request::capture();
        $tabs = ['glitters','colour','info'];


        $setting = Setting::where('name','glitters')->first();

        if ( ! $setting ) {

            $setting = new Setting();
            $setting->fill([
                'name' => 'glitters',
                'value' => 'images'
            ]);
            $setting->save();

        }

        if ( $request->post() ){

        }

        return $this->admin_theme('themes.theme-setting',
                                    [
                                        'configurations' => $this->getConfiguration(),
                                        'setting' => $setting,
                                        'tabs' => $tabs,
                                        'current_tab' => 'glitters'
                                    ]);

    }
    public function header() {

        $request = Request::capture();
        $setting = Setting::where('name','header')->first();

        if ($request->post()) {
            $setting->value = 'header/'.$request->post('header').'/header';
            $setting->additional_text = ['name' => $request->post('header')];
            $setting->save();
            return $this->json(true,'Information Updated.');
        }

        // get all
        return $this->admin_theme('themes.header',['configurations' => $this->getConfiguration(),'setting' => $setting]);
    }
    public function footer() {
        $request = Request::capture();
        $setting = Setting::where('name','footer')->first();

        if ($request->post()) {
            $setting->value = 'footer/'.$request->post('footer').'/footer';
            $setting->additional_text = ['name' => $request->post('footer')];
            $setting->save();
            return $this->json(true,'Information Updated.');
        }

        // get all
        return $this->admin_theme('themes.footer',['configurations' => $this->getConfiguration('footer'),'setting' => $setting]);
    }

    protected function getConfiguration($type = 'header') {
        $base_path = env('APP_THEMES') ?? 'default';
        $folder = resource_path('views'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.$base_path);
        if (! file_exists($folder.DIRECTORY_SEPARATOR.'config.php') ) {
            return [];
        }

        $config = include($folder.DIRECTORY_SEPARATOR.'config.php');
        if ( ! isset ($config[$type]) ) {
            return [];
        }
        return $config[$type];

    }

    /**
     * @info return all settings related to theme,
     * @return void
     */
    public static function themeConfigurations() {
        if (Cache::has('theme_setting') ) {
            return Cache::get('theme_setting');
        }
        $themes = Setting::where('name','glitters')->get();
    }

}
