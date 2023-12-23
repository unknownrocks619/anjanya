<?php

use App\Plugins\Volunteer\Http\Controllers\web\WebVolunteerController;
use Illuminate\Support\Facades\Route;

Route::prefix('volunteer')
        ->middleware(['web'])
        ->group(function() {
            Route::get('registration',[WebVolunteerController::class,'register'])
                    ->name('frontend.volunteer.registration');
            Route::post('volunteer-registration',[WebVolunteerController::class,'volunteerRegistration'])
                ->name('frontend.volunteer.registration-store');
            Route::post('stepback',[WebVolunteerController::class,'stepBack'])
                ->name('frontend.volunteer.registration-step-back');
        });
