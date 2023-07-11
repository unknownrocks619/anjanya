<?php

use App\Http\Controllers\Admin\Post\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('post')
    ->name('posts.')
    ->group(function () {
        Route::match(['get', 'post'], '/', [PostController::class, 'index'])->name('list');
        Route::match(['get', 'post'], '/edit/{post}/{current_tab?}', [PostController::class, 'edit'])->name('edit');
        Route::get('/delete/{post}', [PostController::class, 'delete'])->name('delete');
    });
