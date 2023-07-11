<?php

use App\Http\Controllers\Admin\Sort\SortController;
use Illuminate\Support\Facades\Route;


Route::prefix('sort')
    ->name('sort.')
    ->group(function () {
        Route::post('re-order/{model_name}/{mode_id?}', [SortController::class, 'reorder'])->name('re-order-column');
    });
