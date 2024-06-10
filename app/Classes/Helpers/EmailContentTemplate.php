<?php

namespace App\Classes\Helpers;

use App\Classes\Helpers\SystemSetting;
use App\Models\User;

class EmailContentTemplate
{

    public static function replaceContent(string $content, User $user): string
    {

        if (str_contains($content, '[full_name]')) {
            $content = str_replace('[full_name]', $user->getFullName(), $content);
            $content = str_replace(['[first_name]', '[last_name]'], ['', ''], $content);
        }

        if (str_contains($content, '[first_name]')) {
            $content = str_replace('[first_name]', $user->first_name, $content);
        }

        if (str_contains($content, '[last_name]')) {
            $content = str_replace('[last_name]', $user->last_name, $content);
        }

        if (str_contains($content, '[date]')) {
            $content = str_replace('[date]', date("Y-m-d"), $content);
        }
        if (str_contains($content, '[company_name]')) {
            $content = str_replace('[company_name]', SystemSetting::basic_configuration('site_name'), $content);
        }
        if (str_contains($content, '[company_logo]')) {
            $logo = SystemSetting::logo();
            $img = '';
            if ($logo) {
                $logo = base64_encode(file_get_contents($logo));
                $img = "<img src='data:image/jpeg;base64," . $logo . "' alt='logo' style='width:125px;height:100px;' />";
            }
            $content = str_replace('[company_logo]', $img, $content);
        }
        
        return $content ?? '';
    }
}
