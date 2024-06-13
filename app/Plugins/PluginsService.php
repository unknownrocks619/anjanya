<?php

namespace App\Plugins;

use Illuminate\Support\Facades\View;

class PluginsService
{
    public static function navigation()
    {
        $plugins = [];
        $pluginsFolders = (glob(app_path('Plugins/*'), GLOB_ONLYDIR));

        foreach ($pluginsFolders as $pluginPath) {
            if (!isset (config('plugins')[strtolower(basename($pluginPath))]) || config('plugins')[strtolower(basename($pluginPath))]['enable'] == false) {
                continue;
            }
            $configs = include($pluginPath.DIRECTORY_SEPARATOR.'config.php');
            if (! array_key_exists(basename($pluginPath , $plugins)) ) {
            }
        }
    }


    public static function register(string $plugin_name, mixed $modelInstance) {
        return view($plugin_name.'::frontend.single-post-view',['modelInstance' => $modelInstance])->render();
    }


    /**
     * @param string $plugin_name
     * @param mixed $modelInstance
     * @return bool
     */
    public static function hasSidebar(string $plugin_name, mixed $modelInstance) : bool {
        if (View::exists($plugin_name.'::frontend.sidebar')) {
//            return true;
        }
        return false;
    }

    public static function getSidebar(string $plugin_name, mixed $modelInstance) {
        return view($plugin_name.'::frontend.sidebar',['modelInstance' => $modelInstance])->render();
    }
}
