<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['admin'])
    ->group(function() {
        Route::prefix('room')
            ->name('room.')
            ->controller(\App\Plugins\Rooms\Http\Controllers\RoomController::class)
            ->group(function() {
                Route::get('list','index')->name('list');
                Route::get('create','create')->name('create');
                Route::get('edit/{room}','edit')->name('edit');
                Route::post('edit/{room}','update')->name('update');
                Route::match(['get','post'],'attach_amenities')->name('attach_amenities');
                Route::post('store','store')->name('store');
                Route::match(['get','post','delete'],'delete')->name('delete');
            });

    });
