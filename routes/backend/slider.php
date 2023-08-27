<?php

use App\Http\Controllers\Admin\Slider\SliderAlbumController;
use App\Http\Controllers\Admin\Slider\SliderItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('slider')
    ->name('slider.')
    ->group(function () {
        /** Group */
        Route::prefix('album')
            ->name('album.')
            ->controller(SliderAlbumController::class)
            ->group(function () {
                Route::get('list', 'index')->name('list');
                Route::post('save', 'store')->name('store');
                Route::get('edit/{album}', 'edit')->name('edit');
                Route::post('edit/{album}', 'update')->name('update');
                Route::match(['post','delete'], 'delete/{album}' ,'delete')->name('delete');
            });

        Route::prefix('items/{album}')
            ->name('items.')
            ->controller(SliderItemController::class)
            ->group(function () {
                Route::get('list', 'index')->name('list');
                Route::post('upload', 'store')->name('upload');
                Route::get('edit/{slider}','edit')->name('edit');
                Route::post('edit/{slider}','update')->name('update');
                Route::post('delete/{slider}','delete')->name('delete');
                Route::post('reorder-items','sortSliderItems')->name('reorder');
            });
    });
