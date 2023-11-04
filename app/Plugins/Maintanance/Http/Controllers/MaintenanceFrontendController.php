<?php

namespace App\Plugins\Maintanance\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Plugins\Maintanance\Http\Models\MaintenanaceMode;
use App\Plugins\Maintanance\Http\Models\MaintenanaceModeButtons;

class MaintenanceFrontendController extends Controller
{
    public $plugin_name = 'Maintanance';

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application
     *          \Illuminate\Contracts\View\Factory
     *          \Illuminate\Contracts\View\View
     *          \Illuminate\Foundation\Application
     *          \Illuminate\Http\RedirectResponse
     */
    public function load(string $slug)
    {
        $settingsDetails = MaintenanaceMode::where('slug', $slug)
            ->with(['buttons', 'getImage'])
            ->where('active', true)
            ->first();
        if (!$settingsDetails) {
            return redirect()->to('maintenance');
        }

        $data = [
            'extends' => 'master',
            'maintenanceMode' => $settingsDetails
        ];
        return view('Maintanance::frontend.detail', $data);

    }

    public function page(string $slug,int $page) {
        $settingsDetails = MaintenanaceMode::where('slug', $slug)
            ->with(['buttons', 'getImage'])
            ->where('active', true)
            ->first();
        if (!$settingsDetails) {
            return redirect()->to('maintenance');
        }
        $maintenanceButton = MaintenanaceModeButtons::where('maintenance_mode',$settingsDetails->getKey())
                                                        ->where('id',$page)
                                                        ->first();
        if ( ! $maintenanceButton ) {
            abort(404);
        }
        $data = [
            'extends' => 'master',
            'maintenanceMode' => $settingsDetails,
            'button'    => $maintenanceButton
        ];

        return view('Maintanance::frontend.detail.page', $data);

    }
}
