<?php

use App\Plugins\TeamBuilder\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
        ->name('admin.')
        ->middleware(['admin'])
        ->group(function() {
            Route::prefix('teams')
                ->name('teams.')
                ->controller(TeamController::class)
                ->group(function() {
                    Route::get('list','index')->name('index');
                });

        });
