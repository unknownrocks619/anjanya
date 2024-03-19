<?php
use Illuminate\Support\Facades\Route;
Route::prefix('themes')
        ->name('themes.')
        ->group(function() {
            Route::get('setting',[\App\Http\Controllers\Admin\Themes\HeaderController::class,'themeSettings'])->name('theme-setting');
            Route::match(['get','post'],'header/list',[\App\Http\Controllers\Admin\Themes\HeaderController::class,'header'])->name('header.list');
            Route::match(['get','post'],'footer/list',[\App\Http\Controllers\Admin\Themes\HeaderController::class,'footer'])->name('footer.list');
        });
