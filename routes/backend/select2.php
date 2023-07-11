<?php

use App\Http\Controllers\Admin\Select2\Select2Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('select2')
    ->name('ajax-select2.')
    ->group(function () {

        Route::get('chapters/{course?}/{chapter?}', [Select2Controller::class, 'chapters'])->name('chapters');
        Route::get('categories', [Select2Controller::class, 'categories'])->name('categories');
        Route::get('posts', [Select2Controller::class, 'posts'])->name('posts');
        Route::get('pages', [Select2Controller::class, 'pages'])->name('pages');
    });
