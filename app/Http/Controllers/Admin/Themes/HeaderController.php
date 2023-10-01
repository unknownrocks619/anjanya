<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    protected array $configs = [];
    //
    public function header() {
        // get all
        dd($this->getConfiguration('header'));
    }

    public function footer() {

    }

    protected function getConfiguration($type = 'header') {
        $folderPath = resource_path('views'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.$type);
        $folders = (glob(($folderPath.DIRECTORY_SEPARATOR.'*'),GLOB_ONLYDIR));
        $configs = [];
        foreach ($folders as $folder) {
            if (! file_exists($folder.DIRECTORY_SEPARATOR.'config.php') ) {
                dd('hel',$folder.DIRECTORY_SEPARATOR.'config.php');
                continue;
            }

            $config = include($folder.DIRECTORY_SEPARATOR.'config.php');
            $configs[] = $config;
        }
        dd($configs);

        return $headers;

    }
}
