<?php

use App\Classes\Helpers\ModelConnector;
use Illuminate\Support\Facades\Route;


Route::prefix('connector')
    ->name('connector.')
    ->group(function () {
        Route::post('/connect', [ModelConnector::class, 'store'])->name('store');
        Route::post('/remove/{connector}', [ModelConnector::class, 'remove'])->name('remove');
    });
