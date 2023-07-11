<?php

use App\Http\Controllers\Web\Project\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('project')
    ->name('project.')
    ->group(function () {
        Route::get('api/list/', [ProjectController::class, 'projectAPIList'])->name('api_list');
        Route::match(['get', 'post'], 'project-selection/modal/show', [ProjectController::class, 'projectModalPop'])->name('modal-list');
    });
