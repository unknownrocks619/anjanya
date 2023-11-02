<?php

use App\Plugins\Gallery\Http\Controllers\GalleryAlbumsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin','web'])
        ->group(function (){

        /**
         * Album
         */
            Route::prefix('admin/album-gallery')
                ->controller()
                ->group(function (){

                    Route::get('/index',[GalleryAlbumsController::class,'index'])->name('admin.gallery-album.index');
                    Route::post('store',[GalleryAlbumsController::class,'store'])->name('admin.gallery-album.store');
                });
        /**
         * Gallery Items
         */
            Route::prefix('admin/gallery-items/{album}')
                    ->name('admin.gallery-items.')
                ->group(function (){
//                    Route::get('list',[Album])
                });

        });
