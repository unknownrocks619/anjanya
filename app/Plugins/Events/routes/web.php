<?php
use Illuminate\Support\Facades\Route;

Route::prefix('event')
        ->middleware(['web','maintenance'])
        ->name('frontend.event.')
        ->group(function() {
           Route::get('/{slug}',[\App\Plugins\Events\Http\Controllers\WebEventsController::class,'index'])
               ->name('event-detail');

            Route::post('stepback/{event}',[\App\Plugins\Events\Http\Controllers\WebEventsController::class,'stepBack'])
                ->name('event-step-back');

           Route::get('{slug}/registration/{step?}',[\App\Plugins\Events\Http\Controllers\WebEventsController::class,'eventRegistration'])
               ->name('event-registration');

           Route::match(['post'],'registration/{event}',[\App\Plugins\Events\Http\Controllers\WebEventsController::class,'event_registration_process'])
               ->name('event-registration-process');

           Route::post('registration/upload-photo/{event}',[\App\Plugins\Events\Http\Controllers\WebEventsController::class,'uploadMedia'])
               ->name('event-upload-registration-image');
        });
