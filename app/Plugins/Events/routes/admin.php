<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin/events')
    ->name('admin.events.')
    ->middleware(['web','maintenance'])
    ->controller(\App\Plugins\Events\Http\Controllers\EventsController::class)
    ->group(function() {
        Route::get('/','index')->name('list');
        Route::get('create','add')->name('create');
    });
