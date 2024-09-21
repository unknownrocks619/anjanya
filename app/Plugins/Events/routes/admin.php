<?php

use App\Plugins\Events\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/events')
    ->middleware(['web', 'admin', 'maintenance'])
    ->controller(EventsController::class)
    ->group(function () {
        Route::get('/', 'index')->name('admin.events.list');
        Route::match(['post', 'get'], 'create', 'add')->name('admin.events.create');
        Route::match(['post', 'get'], 'edit/{event}/{tab?}', 'edit')->name('admin.events.edit');
        Route::match(['get', 'post', 'delete'], 'delete/{event}', 'delete')->name('admin.events.delete');
        Route::match(['get'], 'search-user/{event}', 'searchUser')->name('admin.event.search');
        Route::match(['get'], 'download/{event}', 'download')->name('admin.event.download');
        Route::prefix('registration/{event}')
            ->group(function () {
                Route::match(['get', 'post'], 'registration/{type?}/{currentUser?}', [EventsController::class, 'registration'])->name('admin.events.registration');
                Route::get('print/{user}', [EventsController::class, 'print'])->name('admin.events.print');
            });
    });
