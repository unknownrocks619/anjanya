<?php

use App\Plugins\Maintanance\Http\Controllers\MaintenanceModeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/maintenance-mode')
        ->name('admin.maintenance.')
        ->middleware(['web','admin'])
        ->group(function(){
            Route::get('list',[MaintenanceModeController::class,'index'])
                    ->name('list');
            Route::match(['get','post'],'create',[MaintenanceModeController::class,'create'])
                ->name('create');
            Route::post('update/{mode}',[MaintenanceModeController::class,'update'])
                ->name('update');
            Route::match(['get','post'],'edit/{mode}',[MaintenanceModeController::class,'edit'])
                ->name('edit');
            Route::post('store-button/{mode}',[MaintenanceModeController::class,'storeButtons'])
                ->name('store-button');
            Route::match(['get','post'],'delete-button/{button}',[MaintenanceModeController::class,'deleteButton'])
                ->name('delete-button');
        });
