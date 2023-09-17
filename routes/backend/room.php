<?php
use Illuminate\Support\Facades\Route;
Route::prefix('room')
        ->name('room.')
        ->controller(\App\Http\Controllers\Admin\Room\RoomController::class)
        ->group(function() {
            Route::get('list','list')->name('list');
            Route::get('create','create')->name('list');
            Route::get('edit/{room}','edit')->name('edit');
            Route::match(['get','post'],'attach_amenities')->name('attach_amenities');
            Route::post('store','store')->name('store');
            Route::match(['get','post','delete'],'delete')->name('delete');
        });
