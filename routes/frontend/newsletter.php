<?php

use App\Http\Controllers\Web\Subscriber\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::prefix('newsletter')
    ->name('newsletter.')
    ->group(function () {
        Route::match(['get', 'post'], 'news-letter-cancel', [SubscriberController::class, 'index'])->name('cancel');
        Route::post('store', [SubscriberController::class, 'store'])->name('store');
    });
