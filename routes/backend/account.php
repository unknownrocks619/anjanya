<?php

use App\Http\Controllers\Admin\User\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin-account')
    ->name('admin-account.')
    ->group(function () {
        Route::match(['get', 'post'], '/info/{user?}', [AdminLoginController::class, 'account'])->name('settings');
        Route::post('/new-staff-user', [AdminLoginController::class, 'addNewUser'])->name('new-admin-user');
    });
