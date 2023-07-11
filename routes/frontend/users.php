<?php

use App\Http\Controllers\Admin\Select2\Select2Controller;
use App\Http\Controllers\Web\Book\BookController;
use App\Http\Controllers\Web\Course\CourseController;
use App\Http\Controllers\Web\Profile\ProfileController;
use App\Http\Controllers\Web\User\UserController;
use Illuminate\Support\Facades\Route;

Route::name('users.')
    ->group(function () {
        Route::get('login', [UserController::class, 'login'])->name('login');
        Route::post('login', [UserController::class, 'autheticate'])->name('login');
        Route::get('invite/{token}', [UserController::class, 'confirmShare'])->name('invite_user');
        Route::match(['post', 'email'], '/reset', [UserController::class, 'reset'])->name('reset_password');
        Route::post('post-reset', [UserController::class, 'store_reset_password'])->name('store_reset_password');
        Route::get('post-reset/{user}', [UserController::class, 'confirm_reset'])->name('confirm_reset_password');

        Route::match(['post', 'get'], 'forgot-password', [UserController::class, 'reset'])->name('reset');
        Route::match(['post', 'get'], 'register/{current_step?}', [UserController::class, 'register'])->name('register');
        Route::match(['get', 'post'], 'registration/re-submit', [UserController::class, 'resubmit'])->name('resubmit_application');
        Route::match(['get', 'post'], 'registration/re-submit/pin', [UserController::class, 'resubmit_pin'])->name('resubmit_application_pin');
        Route::match(['post'], 'registration/media/upload', [UserController::class, 'updateMedia'])->name('registration.upload');
        Route::match(['get', 'post'], '/verification/account/{user?}', [UserController::class, 'send_verification'])->name('verify_email');

        Route::middleware('auth')
            ->group(function () {
                Route::get('select2/universites/list', [Select2Controller::class, 'universities'])->name('universities_list');
                Route::post('invite-email', [UserController::class, 'invite_email'])->name('invite_email');
                Route::post('logout', [UserController::class, 'logout'])->name('logout');
                Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
                Route::get('profile/courses/{current_tab?}', [CourseController::class, 'profile_course_list'])->name('profile.courses');
                Route::get('profile/books/{current_tab?}', [BookController::class, 'profile_book_list'])->name('profile.books');
                Route::get('profile/purchase/{current_tab?}', function () {
                })->name('profile.purchase');
                Route::post('profile/settings/update-organisation', [UserController::class, 'updateUserOrganisaction'])->name('profile.organisation_update');
                Route::post('profile/settings/bulk-upload', [ProfileController::class, 'uploadImport'])->name('profile.bulk-upload');
                Route::get('profile/settings/{current_tab?}', function () {
                })->name('profile.settings');
            });
    });
