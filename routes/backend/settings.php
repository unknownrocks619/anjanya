<?php

use App\Http\Controllers\Admin\Setting\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')
    ->name('settings.')
    ->group(function () {
        Route::get('/', [SettingController::class, 'index'])
            ->name('list');
        Route::match(['get', 'post'], '/footer', [SettingController::class, 'footer'])
            ->name('footer-page');

        Route::match(['get', 'post'], '/page-setting', [SettingController::class, 'page_setting'])
            ->name('page-setting');


        Route::post('/basic-settings', [SettingController::class, 'basic_configuration'])
            ->name('basic-settings');

        Route::post('/social-settings', [SettingController::class, 'social_configuration'])
            ->name('save-social-configuration');

        Route::post('/logo-settings', [SettingController::class, 'logo_configuration'])
            ->name('logo-settings');

        Route::post('/basic-contact-setting', [SettingController::class, 'primary_contact_configuration'])
            ->name('basic-contact-settings');

        Route::post('/registration-welcome-email', [SettingController::class, 'welcome_email_text'])
            ->name('registration-welcome-email');

        Route::post('/membership-registration-email', [SettingController::class, 'welcome_membership_text'])
            ->name('membership-registration-email');

        Route::post('/membership-approved-registration-email', [SettingController::class, 'membership_approved_text'])
            ->name('membership-approved-registration-email');

        Route::post('/membership-rejected-registration-email', [SettingController::class, 'membership_rejected_text'])
            ->name('membership-rejected-registration-email');
    });
