<?php

use App\Http\Controllers\Admin\Book\BookBundleController;
use App\Http\Controllers\Admin\Book\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix('books')
    ->name('book.')
    ->group(function () {
        Route::get('list', [BookController::class, 'index'])->name('list');
        Route::match(['get', 'post'], 'add/{book?}/{current_tab?}', [BookController::class, 'edit'])->name('edit');
        Route::post('upload/{book?}', [BookController::class, 'uploadBook'])->name('upload');
        Route::match(['post', 'delete'], 'delete/{book?}', [BookController::class, 'deleteBook'])->name('delete');


        Route::prefix('bundle')
            ->name('bundle.')
            ->group(function () {
                Route::get('index', [BookBundleController::class, 'index'])->name('list');
                Route::post('store', [BookBundleController::class, 'store'])->name('store');
                Route::match(['get', 'post'], 'edit/{bundle}/{current_tab?}', [BookBundleController::class, 'edit'])->name('edit');
                Route::post('delete/{bundle}', [BookBundleController::class, 'delete'])->name('delete');
            });
    });
