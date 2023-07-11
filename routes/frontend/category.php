<?php

use App\Http\Controllers\Web\Category\CategoryController;
use App\Http\Controllers\Web\Post\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix("category")
    ->name('category.')
    ->group(function () {

        Route::get('/', [CategoryController::class, 'index'])->name('list');
        Route::get('/{slug}', [CategoryController::class, 'show'])->name('detail');
        Route::get('/type/{post_type}', [PostController::class, 'post_type'])->name('post-type');
        Route::get('/{slug}/{post_slug}', [PostController::class, 'load'])->name('post');
    });
