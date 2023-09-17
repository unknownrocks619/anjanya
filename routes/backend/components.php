<?php

use App\Classes\Helpers\Components;
use Illuminate\Support\Facades\Route;

Route::prefix('components')
    ->name('components.')
    ->group(function () {
        Route::post('rename/{componentBuilder}', [Components::class, 'renameComponent'])->name('rename');
        Route::match(['post', 'get'], '/list', [Components::class, 'getComponentList'])->name('list');
        Route::match(['post'], '/select', [Components::class, 'renderElement'])->name('render');
        Route::post('save', [Components::class, 'save'])->name('save');
        Route::post('udpate/{componentBuilder}', [Components::class, 'update'])->name('update');
        Route::post('delete/{componentBuilder}', [Components::class, 'delete'])->name('delete');
        Route::post('update/{componentBuilder}/position', [Components::class, 'update_position'])->name('update-position');
        Route::post('update/{componentBuilder}/{index?}', [Components::class, 'removeElement'])->name('delete-element');
        Route::post('remove-card-media/{componentBuilder}/{index}', [Components::class, 'removeCardMedia'])->name('delete-card-media');

        Route::prefix('common')
                ->name('common.')
                ->controller(\App\Http\Controllers\Admin\Component\ComponentController::class)
                ->group(function() {
                   Route::get('list','index')->name('list');
                   Route::get('build/{component?}/{webcomponent?}','builder')->name('create');
                    Route::get('build-edit/{webcomponent}','edit')->name('edit');
                   Route::post('build-save/{component_name?}','save')->name('save');
                    Route::post('build-update/{webcomponent}','update')->name('udpate');
                   Route::post('upload-image/{component_name}','uploadImage')->name('upload-image');
                    Route::post('upload-common-component/{webComponent}','deleteCommonComponent')->name('delete-common-component');
                   Route::post('delete-component/{webcomponent}/{componentBuilder}','deleteComponent')->name('delete-component');
                });
    });
