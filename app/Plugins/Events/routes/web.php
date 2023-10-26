<?php
use Illuminate\Support\Facades\Route;

Route::prefix('event')
        ->middleware(['web','maintenance'])
        ->name('frontend.event.')
        ->group(function() {
           Route::get('/{slug}',[\App\Plugins\Events\Http\Controllers\WebEventsController::class,'index'])->name('event-detail');
        });
