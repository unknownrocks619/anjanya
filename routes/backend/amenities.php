<?php
use Illuminate\Support\Facades\Route;
Route::prefix('amenities')
        ->name('amenities.')
        ->controller(App\Http\Controllers\Admin\Amenities\AmenitiesController::class)
        ->group(function() {
            Route::get('list','index')->name('list');
            Route::get('create','index')->name('create');
            Route::get('edit/{amenities}','edit')->name('edit');
            Route::post('edit/{amenities}','update')->name('edit');
            Route::post('store','store')->name('store');
        });
