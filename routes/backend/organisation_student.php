<?php

use App\Http\Controllers\Admin\Organisation\OrganisationStudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('organsiation-student')
    ->name('organisation_student.')
    ->group(function () {
        Route::post('store/{organisation}', [OrganisationStudentController::class, 'store'])->name('organisation_student_store');
    });
