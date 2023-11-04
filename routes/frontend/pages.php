<?php

use App\Http\Controllers\Web\Menu\MenuController;
use Illuminate\Support\Facades\Route;


Route::name('pages.')
    ->group(function () {
        Route::get('/menus',[MenuController::class,'menuList'])->name('menu-list');
        Route::get("{slug}", [MenuController::class, 'load'])->name('menu');
        Route::get("page/{slug}", [MenuController::class, 'pageLoad'])->name('page');
    });
