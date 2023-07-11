<?php

use App\Http\Controllers\Web\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')
    ->name('profile.')
    ->middleware(['auth'])
    ->group(function () {
        Route::match(['post', 'get'], 'settings', [ProfileController::class, 'settings'])->name("settings");
        Route::post('remove-profile', [ProfileController::class, 'remove_profile_picture'])->name('remove_profile_picture');
    });
