<?php

use App\Http\Controllers\Admin\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('category')
    ->name('categories.')
    ->group(function () {
        Route::get('list', [CategoryController::class, 'index'])->name('list');
        Route::post('create', [CategoryController::class, 'create'])->name('create');
        Route::match(['get', 'post'], '{category}/edit/{current_tab?}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('{category}/delete', [CategoryController::class, 'delete'])->name('delete');
    });
