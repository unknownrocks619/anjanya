<?php
use Illuminate\Support\Facades\Route;

Route::prefix('file/download')
        ->group(function(){
           Route::get('associated-file/{image_relation}/{image}',[\App\Http\Controllers\Admin\Media\MediaController::class,'downloadImage'])->name('media.download');

        });
