<?php

namespace App\Plugins\Maintanance\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Plugins\Maintanance\Http\Models\MaintenanaceMode;

class MaintenanceFrontendController extends Controller
{
    public $plugin_name = 'Maintanance';

    public function load(string $slug) {
        $settingsDetails = MaintenanaceMode::where('slug',$slug)
                                                ->with(['buttons','getImage'])
                                                ->where('active',true)
                                                ->first();
        if (! $settingsDetails ) {
            return redirect()->to('maintenance');
        }

        $data = [
            'extends'   => 'master',
            'maintenanceMode'      => $settingsDetails
        ];
        return view('Maintanance::frontend.detail',$data);

    }
}
