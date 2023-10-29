<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['admin','web'])
        ->group(function (){

        /**
         * Album
         */
            Route::prefix('gallery-album')
                ->name('gallery-album.')
                ->controller()
                ->group(function (){
                    Route::get('list')->name('list');
                });
        /**
         * Gallery Items
         */
            Route::prefix('gallery-items')
                ->group(function (){

                });

        });
