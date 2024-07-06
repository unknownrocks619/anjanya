<?php

use App\Plugins\Product\Http\Controllers\WebProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')
        ->middleware(['web','maintenance'])
        ->group(function(){
            Route::get('{slug}',[WebProductController::class,'load'])->name('product.detail');
            Route::post('enquiry/{product}/{slug}',[WebProductController::class,'submitProductEnquiry'])->name('product.enquiry');
    });