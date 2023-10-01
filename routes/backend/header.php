<?php
use Illuminate\Support\Facades\Route;
Route::prefix('themes')
        ->name('themes.')
        ->group(function() {
            Route::get('header/list',[\App\Http\Controllers\Admin\Themes\HeaderController::class,'header'])->name('header.list');
            Route::get('footer/list',[\App\Http\Controllers\Admin\Themes\HeaderController::class,'footer'])->name('footer.list');
        });
