<?php

use App\Http\Controllers\Admin\Courses\ChapterController;
use App\Http\Controllers\Admin\Courses\CoursesController;
use App\Http\Controllers\Admin\Courses\LessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('courses')
    ->name('courses.')
    ->group(function () {
        Route::match(['post', 'get'], 'list', [CoursesController::class, 'index'])->name('list');
        Route::match(['post', 'get'], '{course}/edit/{current_tab?}', [CoursesController::class, 'edit'])->name('edit');
        Route::post('intro-video/{course}', [CoursesController::class, 'intro_video'])->name('intro-video');
        Route::post('intro-video/{course}/remove', [CoursesController::class, 'remove_video'])->name('remove-video');
        Route::post('delete/{course}', [CoursesController::class, 'delete'])->name('delete_course');
    });


Route::prefix('chapters')
    ->name('chapters.')
    ->group(function () {
        Route::get('list', [ChapterController::class, 'index'])->name('list');
        Route::match(['post', 'get'], 'create/{current_tab?}/{course?}', [ChapterController::class, 'create'])->name('create');
        Route::match(['post', 'get'], 'edit/{chapter}/{current_tab?}/{course?}', [ChapterController::class, 'edit'])->name('edit');
        Route::post('delete/{chapter}', [ChapterController::class, 'delete'])->name('delete_course');
    });


Route::prefix('lessions')
    ->name('lessions.')
    ->group(function () {
        Route::get('/list', [LessionController::class, 'index'])->name('list');
        Route::match(['post', 'get'], '/create/{chapter?}/{course?}/{current_tab?}', [LessionController::class, 'create'])->name('create');
        Route::match(['post', 'get'], '{lession}/edit/{current_tab?}/{chapter?}/{course?}', [LessionController::class, 'edit'])->name('edit');
        Route::post('delete/{lession}', [LessionController::class, 'delete'])->name('delete_lession');
    });
