<?php
use Illuminate\Support\Facades\Route;

Route::prefix('room')
        ->name('room.')
        ->middleware(['web','maintenance'])
        ->controller(\App\Plugins\Rooms\Http\Controllers\FrontendRoomController::class)
        ->group(function() {
            Route::get('/','rooms')->name('all');
            Route::get('{slug}','detail')->name('detail');
            Route::match(['post','get'],'booking/{slug?}',[\App\Plugins\Rooms\Http\Controllers\BookingController::class,'booking'])->name('booking');
        });
