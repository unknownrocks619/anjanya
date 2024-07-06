<?php

use App\Plugins\Product\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin','web'])
        ->prefix('admin/products')
        ->group(function(){
            Route::get('index',[ProductController::class,'index'])->name('admin.products.index');
            Route::match(['post','get'],'add',[ProductController::class,'create'])->name('admin.products.create');
            Route::match(['get','post'],'edit/{product}/{current_tab?}',[ProductController::class,'edit'])->name('admin.products.edit');
            Route::match(['post','delete'],'delete/{product}',[ProductController::class,'delete'])->name('admin.products.delete');
            /**
             * Additional Content
             */
            Route::prefix('{product}/additional')
                    ->group(function() {
                        Route::post('/store',[ProductController::class,'additionalContent'])->name('admin.products.additional-content.store');
                        Route::match(['post','get'],'/edit/{additionalProduct}',[ProductController::class,'updateAdditionalContent'])->name('admin.products.additional-content.update');
                        Route::match(['post','delete'],'delete/{additionalProduct}',[ProductController::class,'deleteAdditionalContent'])->name('admin.products.additional-content.delete');
                    });
            /**
             * Video Content
             */
            Route::prefix('{product}/video')
                    ->group(function() {
                        Route::post('/store',[ProductController::class,'productVideo'])->name('admin.products.product-video.store');
                        Route::match(['post','get'],'/edit/{video}',[ProductController::class,'updateProductVideo'])->name('admin.products.product-video.update');
                        Route::match(['post','delete'],'delete/{video}',[ProductController::class,'deleteProductVideo'])->name('admin.products.product-video.delete');

                    });
        });
