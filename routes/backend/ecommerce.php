<?php

use App\Http\Controllers\Admin\Ecommerce\EcommerceController;
use App\Http\Controllers\Admin\Orders\OrderController;
use App\Http\Controllers\Admin\Orders\OrderLogController;
use App\Http\Controllers\Admin\Orders\TransactionsController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;


Route::prefix('ecommerce')
    ->name('ecom.')
    ->group(function () {
        Route::get('list', [EcommerceController::class, 'index'])->name('list');
        Route::match(['post', 'get'], 'edit/{product?}/{current_tab?}/{book?}', [EcommerceController::class, 'edit'])->name('edit');
        Route::post('convert/{book}', [EcommerceController::class, 'convert_to_product'])->name('convert_book');
        Route::post('delete/{product}', [EcommerceController::class, 'delete_product'])->name('delete_product');
    });

Route::prefix('orders')
    ->name('orders.')
    ->group(function () {
        Route::get('/list', [OrderController::class, 'index'])->name('list');
        Route::get('/edit/{order}/{current_tab?}', [OrderController::class, 'edit'])->name('edit');
        Route::get('log/{order}', [OrderLogController::class, 'getLog'])->name('list_log');
        Route::post('update-status/{order}/{type?}', [OrderController::class, 'update_status'])->name('update-order-status');
    });

Route::prefix('transactions')
    ->name('transactions.')
    ->group(function () {
        Route::get('/list', [TransactionsController::class, 'index'])->name('list');
    });
