<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['web','admin'])
        ->name('admin.clients.')
        ->prefix('admin/clients')
        ->controller(\App\Plugins\Clients\Http\Controllers\ClientController::class)
        ->group(function () {
           Route::get('list','index')->name('list');
           Route::get('edit/{client}','edit')->name('edit');
           Route::post('store','store')->name('store');
           Route::post('update/{client}','update')->name('update');
           Route::match(['get','post','delete'],'delete/{client}','delete')->name('delete');
        });
