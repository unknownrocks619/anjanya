<?php

use App\Http\Controllers\Admin\Seo\SeoController;
use Illuminate\Support\Facades\Route;

Route::prefix('seo')
    ->name('seo.')
    ->controller(SeoController::class)
    ->group(function () {
        Route::post('store/{model}', 'store')->name('store');
        Route::post('/update/{seo}', 'update')->name('update');
        Route::match(['post', 'delete'], 'remove/{remove_seo}', 'remove_seo')->name('delete');
    });
