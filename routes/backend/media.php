<?php

use App\Http\Controllers\Admin\Media\MediaController;
use Illuminate\Support\Facades\Route;


Route::prefix('media')
    ->name('media.')
    ->group(function () {
        Route::post('upload', [MediaController::class, 'uploadImage'])->name('upload');
        Route::match(['post', 'get'], 'update-image-type/{image_relation}', [MediaController::class, 'update_image_relation'])->name('update_image_type');
        Route::match(['post', 'get'], 'remove-image-relation/{image_relation}/{current_tab?}', [MediaController::class, 'remove_image'])->name('remove_image');
        Route::match('get','download-file/{image_relation}/{image}',[MediaController::class,'downloadImage'])->name('download-image');
    });
