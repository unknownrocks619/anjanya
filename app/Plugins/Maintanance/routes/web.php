<?php

use App\Plugins\Maintanance\Http\Controllers\MaintenanceFrontendController;
use Illuminate\Support\Facades\Route;
Route::prefix('maintenance')
        ->name('frontend.maintenance-mode.')
        ->middleware(['web'])
        ->group(function(){
            Route::get('{slug}',[MaintenanceFrontendController::class,'load'])
                ->name('mode-settings');
        });
