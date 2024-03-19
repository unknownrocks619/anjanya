<?php

use App\Plugins\Events\Http\Controllers\WebEventsController;
use Illuminate\Support\Facades\Route;

Route::prefix('event')
        ->middleware(['web','maintenance'])
        ->name('frontend.event.')
        ->group(function() {
           Route::get('/{slug}',[WebEventsController::class,'index'])
               ->name('event-detail');

            Route::post('stepback/{event}',[WebEventsController::class,'stepBack'])
                ->name('event-step-back');

           Route::get('{slug}/registration/{step?}',[WebEventsController::class,'eventRegistration'])
               ->name('event-registration');

           Route::match(['post'],'registration/{event}',[WebEventsController::class,'event_registration_process'])
               ->name('event-registration-process');

           Route::post('registration/upload-photo/{event}',[WebEventsController::class,'uploadMedia'])
               ->name('event-upload-registration-image');

           Route::match(['get','post'],'refer/{user}/{event}',[WebEventsController::class,'referer'])
                ->name('refer-friend-family');

            Route::match(['get','post'],'refer-program/{user}/complete/{event}',[WebEventsController::class,'refererComplete'])
                ->name('refer-friend-family-complete');
        });
