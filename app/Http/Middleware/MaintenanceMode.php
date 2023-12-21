<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Database\Seeders\SystemSettingInstagramConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenanceSetting = Setting::where('name', 'maintenance_mode')->first();
        if (!$maintenanceSetting) {
            (new SystemSettingInstagramConfiguration())->social_instagram_footer_images();
            $maintenanceSetting = Setting::where('name', 'maintenance_mode')->first();
        }

        // skip for following url :
        $whiteListURL = [
                            'https://himalayan.siddhamahayog.org/event/satsang-and-aashirvachan/registration',
                            'https://himalayan.siddhamahayog.org/event/registration/2',
                            'https://himalayan.siddhamahayog.org/event/stepback/2',
                            'https://himalayan.siddhamahayog.org/newsletter/store',
                            'https://himalayan.siddhamahayog.org/event/hanumad-mahayagya/registration',
                            'https://himalayan.siddhamahayog.org/event/registration/1',
                            'https://himalayan.siddhamahayog.org/event/stepback/1',
                            'https://himalayan.siddhamahayog.org/event/registration/upload-photo/1',
                            'https://himalayan.siddhamahayog.org/event/registration/3',
                            'https://himalayan.siddhamahayog.org/event/anjaneya-youth-meeting/registration'
                    ];

        if (in_array(url()->current(),$whiteListURL) ) {
            return $next($request);
        }

        if ($maintenanceSetting->value && Route::currentRouteName() != 'frontend.maintenance-mode' && !auth()->guard('admin')->check()) {
            return redirect()->to('maintenance');
        }

        return $next($request);
    }
}
