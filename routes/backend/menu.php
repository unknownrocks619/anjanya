<?php

use App\Http\Controllers\Admin\Menu\MenuController;
use Illuminate\Support\Facades\Route;

Route::prefix('menu')
    ->name('menu.')
    ->group(function () {
        Route::get('/list', [MenuController::class, 'index'])->name('list');
        Route::get('/clear-cache', [MenuController::class, 'clearCache'])->name('clear_cache');
        Route::post('re-order/{menu?}', [MenuController::class, 'reorder'])->name('reorder');
        Route::get('/{menu}/edit/{current_tab?}', [MenuController::class, 'edit'])->name('edit');
        Route::get('json/{selectionMenu?}', [MenuController::class, 'menu_json'])->name('json_output');
        Route::match(['post', 'get'], 'create', [MenuController::class, 'create'])->name('create');
        Route::post('delete/{menu}', [MenuController::class, 'delete'])->name('delete_menu');
        /**
         * Image
         */
        Route::post('/upload/{menu}', [MenuController::class, 'uploadImage'])->name('upload');
        Route::match(['post', 'delete'], '/image/{menu}/delete/{image_relation}/{current_tab?}', [MenuController::class, 'remove_image'])->name('remove_image');
        Route::match(
            ['post', 'get'],
            '/image/{menu}/update/{image_relation}/{current_tab?}',
            [
                MenuController::class,
                'update_image_relation'
            ]
        )
            ->name('update_image_type');
    });
