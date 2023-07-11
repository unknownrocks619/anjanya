<?php

use App\Http\Controllers\Admin\Page\PageController;
use Illuminate\Support\Facades\Route;

Route::prefix('pages')
    ->name('pages.')
    ->group(function () {
        Route::get('list', [PageController::class, 'index'])->name('list');
        Route::get('{page}/edit/{current_tab?}', [PageController::class, 'edit'])->name('edit');

        Route::post('create', [PageController::class, 'store'])->name('create');
        Route::post('{page}/edit', [PageController::class, 'update'])->name('update');
        Route::post('delete/{page}', [PageController::class, 'delete'])->name('delete');
        /**
         * Gallery
         */
        Route::post('/upload/{page}', [PageController::class, 'uploadImage'])->name('upload');
        Route::match(['post', 'delete'], '/image/{page}/delete/{image_relation}/{current_tab?}', [PageController::class, 'remove_image'])->name('remove_image');
        Route::match(
            ['post', 'get'],
            '/image/{page}/update/{image_relation}/{current_tab?}',
            [
                PageController::class,
                'update_image_relation'
            ]
        )
            ->name('update_image_type');
    });
