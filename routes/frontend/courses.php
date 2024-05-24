<?php

use App\Http\Controllers\Web\Course\CourseController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::prefix('course')
    ->name('courses.')
    ->group(function () {

        if (Schema::hasTable('courses')) {
            Route::get('/', [CourseController::class, 'load']);
            Route::get('{course_slug}/{options?}', [CourseController::class, 'load'])->name('load');
            Route::get('{course_slug}/{lession}/watch/{chapter}/{course?}', [CourseController::class, 'navi'])->name('course_switch');
            Route::prefix('{course_slug}/enroll')
                ->name('enroll.')
                ->group(function () {
                    Route::match(['get','post'],'/{course}', [CourseController::class, 'enroll'])->name('enroll');
                    Route::get('/{course}/enroll-complete',[CourseController::class,'enrollComplete'])->name('enroll.complete');
                });

            Route::post('/mark/{lession}/complete/{chapter}/{course?}', [CourseController::class, 'complete'])->name('complete');
            $courses = Course::select('slug')->where('active', true)->get();
        }
    });
