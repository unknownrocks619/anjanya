<?php

use App\Http\Controllers\Web\Book\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix('books')
    ->name('books.')
    ->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('list');
        Route::get('/bundle/{slug}', [BookController::class, 'bundle_show'])->name('bundle_show');
        Route::post('modal/{product}', [BookController::class, 'showDefaultProductModal'])->name('default_selection');

        Route::prefix('upload')->group(function () {
            Route::get('/', [BookController::class, 'upload'])->name('upload');
            Route::middleware('auth')
                ->group(function () {
                    Route::match(['get', 'post'], '/upload/{book?}/{current_tab?}', [BookController::class, 'upload'])->name('upload_user');
                    Route::post('validate-book/{book}', [BookController::class, 'validate_book'])->name('validate-book');
                    Route::post('delete-book/{book}', [BookController::class, 'destroy'])->name('delete_book');
                });
        });

        Route::get('{slug}', [BookController::class, 'show'])->name('detail');
    });
