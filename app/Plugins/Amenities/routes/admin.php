<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
        ->name('admin.')
        ->middleware(['admin'])
        ->group(function() {
            Route::prefix('amenities')
                ->name('amenities.')
                ->controller(\App\Plugins\Amenities\Http\Controllers\AmenitiesController::class)
                ->group(function() {
                    Route::get('list','index')->name('list');
                    Route::get('edit/{amenity}','edit')->name('edit');
                    Route::post('edit/{amenity}','update')->name('update');
                    Route::post('store','store')->name('store');
                    Route::post('delete/{amenity}','delete')->name('delete');
                });

        });
