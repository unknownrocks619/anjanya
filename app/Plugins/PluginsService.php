<?php

namespace App\Plugins;

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
}
