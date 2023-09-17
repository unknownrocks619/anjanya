<?php
use Illuminate\Support\Facades\Route;
Route::middleware(['admin'])
        ->name('admin.testimonials.')
        ->prefix('testimonials')
        ->controller(\App\Plugins\Testimonials\Http\Controllers\TestimonialsController::class)
        ->group(function() {
            Route::get('/','index')->name('list');
            Route::get('add','create')->name('create');
            Route::get('edit/{testimonial}','edit')->name('edit');
            Route::post('store','store')->name('store');
            Route::post('/update/{testimonial}','update')->name('update');
            Route::match(['get','post','delete'],'/delete/{testimonial}','delete')->name('delete');
        });
