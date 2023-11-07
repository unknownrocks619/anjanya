<?php

use App\Http\Controllers\Admin\Gallery\AlbumController;
use App\Http\Controllers\Admin\Gallery\AlbumItemsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin','web'])
    ->group(function (){

        /**
         * Album
         */
        Route::prefix('album-gallery')
            ->group(function (){
                Route::get('index',[AlbumController::class,'index'])->name('gallery-album.index');
                Route::post('store',[AlbumController::class,'store'])->name('gallery-album.store');
            });
        /**
         * Gallery Items
         */
        Route::prefix('admin/gallery-items/{album}')
            ->group(function (){
                    Route::get('list',[AlbumItemsController::class,'index'])->name('gallery-items.list');
                    Route::post('store',[AlbumItemsController::class,'uploadPhotos'])->name('gallery-items.store');
                    Route::match(['get','post'],'reorder-items',[AlbumItemsController::class,'sortGalleryItems'])->name('gallery-items.reorder');
                    Route::get('edit/{item}',[AlbumItemsController::class,'editGalleryItem'])->name('gallery-items.edit');
                    Route::post('edit/{item}',[AlbumItemsController::class,'updateGalleryItem'])->name('gallery-items.update');
                    Route::match(['get','post'],'delete/{item}',[AlbumItemsController::class,'deleteGalleryItem'])->name('gallery-items.delete');
            });

    });
