<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\User\AdminLoginController;


Route::prefix("admin")
    ->name('admin.')
    ->controller(AdminLoginController::class)
    ->group(function () {
        Route::get('/login', "index")->name('login');
        Route::post('/login', "autheticate")->name('login');
    });
