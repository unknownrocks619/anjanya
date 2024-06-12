<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
        ->name('admin.')
        ->middleware(['admin'])
        ->group(function() {
            Route::prefix('teams')
                ->name('teams.')
                ->controller(\App\Plugins\Amenities\Http\Controllers\AmenitiesController::class)
                ->group(function() {
                    Route::get('list','index')->name('index');
                });

        });
