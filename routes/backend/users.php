<?php

use App\Http\Controllers\Admin\Select2\Select2Controller;
use App\Http\Controllers\Admin\User\ApplicationController;
use App\Http\Controllers\Admin\User\ApplicationPaymentController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('users.')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/list/', 'index')->name('list');
        Route::post('/save', 'store')->name('save');

        Route::prefix('customers')
            ->name('customers.')
            ->group(function () {
                Route::get('ajax-list', [Select2Controller::class, 'users'])->name('select2-users');
                Route::get('list/{options?}', [UserController::class, 'customer_index'])->name('index');
                Route::match(['get', 'post'], '{customer}/edit/{current_tab?}', [UserController::class, 'edit_customer'])->name('edit');
                Route::post('update-password/{customer}/edit', [UserController::class, 'updatePassword'])->name('update_password');
                Route::post('/bulk-upload/{customer}', [UserController::class, 'uploadFile'])->name('upload-file');
                Route::get('/login-as-user/{user}', [UserController::class, 'viewAsCustomer'])->name('login_as_user');
                Route::post('/logout-as-user/{user}', [UserController::class, 'logoutAsUser'])->name('logout_as_user');
            });

        Route::prefix('applications')
            ->name('applications.')
            ->group(function () {
                Route::get('/{filter?}', [ApplicationController::class, 'index'])->name('list');
                Route::get('/edit/{application}/{current_tab?}', [ApplicationController::class, 'edit'])->name('edit');
                Route::match(['get', 'post'], '/reject/{application}/{user}', [ApplicationController::class, 'rejectApplication'])->name('reject');
                Route::match(['get', 'post'], '/approve/{application}/{user}', [ApplicationController::class, 'approveApplication'])->name('approve');
                Route::match(['get', 'post'], '/application/profile-status/{application}/{status?}', [ApplicationController::class, 'profile_status'])->name('profile_status');
                Route::match(['get', 'post'], '/application/identity-status/{application}/{status?}', [ApplicationController::class, 'identity_status'])->name('identity_status');

                Route::prefix('payments')
                    ->name('payments.')
                    ->group(function () {
                        Route::post('save/{application}/{user}', [ApplicationPaymentController::class, 'store'])->name('save');
                    });
            });
    });
