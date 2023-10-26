<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin/events')
    ->name('admin.events.')
    ->middleware(['web','maintenance'])
    ->controller(\App\Plugins\Events\Http\Controllers\EventsController::class)
    ->group(function() {
        Route::get('/','index')->name('list');
        Route::match(['post','get'],'create','add')->name('create');
        Route::match(['post','get'],'edit/{event}/{tab?}','edit')->name('edit');
        Route::match(['get','post','delete'],'delete/{event}','delete')->name('delete');
    });
