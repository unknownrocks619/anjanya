<?php

use App\Http\Controllers\Admin\Organisation\DonationBreaksController;
use App\Http\Controllers\Admin\Organisation\OrganisationController;
use App\Http\Controllers\Admin\Organisation\ProjectController;
use App\Http\Controllers\Admin\Organisation\ProjectTransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('organisation')
    ->name('org.')
    ->group(function () {
        Route::match(['post', 'get'], '/list', [OrganisationController::class, 'index'])->name('list');
        Route::match(['post', 'get'], '/edit/{org}/{current_tab?}', [OrganisationController::class, 'edit'])->name('edit');
        Route::match(
            ['post', 'get'],
            '/image/{org}/edit/{image_relation}/{current_tab?}',
            [
                OrganisationController::class,
                'update_image_relation'
            ]
        )
            ->name('update_image_type');
        Route::post('/upload/{org}/{current_tab?}', [OrganisationController::class, 'uploadImage'])->name('upload');
        Route::match(['post', 'delete'], '/image/{org}/delete/{image_relation}/{current_tab?}', [OrganisationController::class, 'remove_image'])->name('remove_image');

        /**
         * Projects
         */
        Route::prefix('/project')
            ->name('projects.')
            ->group(function () {
                Route::get('list/{current_tab?}/{org?}', [ProjectController::class, 'index'])->name('list');
                Route::match(['get', 'post'], 'add/{org?}', [ProjectController::class, 'create'])->name('add');
                Route::get('{project}/edit/{current_tab?}/{org?}/', [ProjectController::class, 'edit'])->name('edit');

                Route::match(
                    ['post', 'get'],
                    '/image/{project}/update/{image_relation}/{current_tab?}',
                    [
                        ProjectController::class,
                        'update_image_relation'
                    ]
                )
                    ->name('update_image_type');

                Route::post('/upload/{project}/{current_tab?}/{org?}', [ProjectController::class, 'uploadImage'])->name('upload');
                Route::post('{project}/edit/{org?}', [ProjectController::class, 'update'])->name('update');
                Route::post('{project}/delete/{org?}/', [ProjectController::class, 'delete'])->name('delete');
                Route::post('/{project}/budget-info/{current_tab}/{org?}', [ProjectController::class, 'updateBudgetInfo'])->name('update_budget_info');
                Route::post('/add/breaks/{project}/{current_tab?}/{org?}', [ProjectController::class, 'storeBudgetInfo'])->name('store_pricing_breaks');
                Route::match(['post', 'delete'], '/image/{project}/delete/{image_relation}/{current_tab?}/{org?}', [ProjectController::class, 'remove_image'])->name('remove_image');
            });

        /**
         * Transactions
         */
        Route::prefix('transactions')
            ->name('transactions.')
            ->group(function () {
                Route::get('list/{project?}', [ProjectTransactionController::class, 'index'])->name('list');
            });

        /**
         * Donations
         */
        Route::prefix('donations')
            ->name('donations.')
            ->group(function () {
                Route::match(
                    ['post', 'delete'],
                    "/delete/{donation_breaks}/{project}/{current_tab?}/{org?}",
                    [DonationBreaksController::class, 'destroy']
                )
                    ->name('destroy');
            });
    });
