<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['admin','web'])
        ->group(function (){

        /**
         * Album
         */
            Route::prefix('gallery-album')
                ->group(function (){

                });
        /**
         * Gallery Items
         */
            Route::prefix('gallery-items')
                ->group(function (){

                });

        });
