<?php

use App\Http\Controllers\Web\Course\CourseController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::prefix('course')
    ->name('courses.')
    ->group(function () {

        // if (Schema::hasTable('courses')) {
        //     Route::get('/', [CourseController::class, 'load']);
        //     Route::get('{course_slug}/{options?}', [CourseController::class, 'load']);
        //     Route::get('{course_slug}/{lession}/watch/{chapter}/{course?}', [CourseController::class, 'navi'])->name('course_switch');
        //     Route::prefix('{course}')
        //         ->name('enroll.')
        //         ->group(function () {
        //             Route::post('/enroll', [CourseController::class, 'enroll'])->name('enroll');
        //         });

        //     Route::post('/mark/{lession}/complete/{chapter}/{course?}', [CourseController::class, 'complete'])->name('complete');
        //     $courses = Course::select('slug')->where('active', true)->get();
        // }
    });
