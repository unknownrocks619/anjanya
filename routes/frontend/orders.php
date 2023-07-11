<?php

use App\Http\Controllers\Web\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix("orders")
    ->name('orders.')
    ->group(function () {
        Route::post('/create', [OrderController::class, 'createOrder'])->name('order');
        Route::post('/update-order/{orderLine}', [OrderController::class, 'update'])->name('update');
        Route::match(['get', 'post'], 'checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::get('stripe/payment-response', [OrderController::class, 'stripe_payment_response'])->name('stripe_response');
        Route::get('/payment-complete', [OrderController::class, 'postCheckOut'])->name('complete-checkout');
        Route::post('update-basic-info/{order}', [OrderController::class, 'updateUserInfo'])->name('update_basic_detail');
    });
