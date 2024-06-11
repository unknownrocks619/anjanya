<?php

use App\Classes\Helpers\Menu;
use App\Classes\Helpers\SystemSetting;
use App\Http\Controllers\Test\CodeTestZone;
use App\Http\Controllers\Web\Menu\MenuController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::middleware(['web', 'maintenance'])
    ->name('frontend.')
    ->group(function () {

        /**
         * Code Test Zone
         */
        // Route::get('test-zone', [CodeTestZone::class, 'index']);

        Route::get('maintenance', function () {
            // check if we need to display this.
            if (! Setting::where('name','maintenance_mode')->where('value',1)->exists() ) {
                abort(404);
            }
            
            return view('maintenance.index');
        })->name('maintenance-mode');

        Route::get('/', [MenuController::class, 'load'])->name('home');
        Route::post('/contact-submission-form', [MenuController::class, 'submit_contact_us'])->name('submit_contanct_us');

        /**
         * Static
         */
        Route::get('/report-a-problem', function () {
            return view('frontend.report');
        });

        /**
         * News letter
         */
        include __DIR__ . '/newsletter.php';

        /**
         * Profile
         */
        include __DIR__ . '/profile.php';

        /**
         * Users
         */

        include __DIR__ . '/users.php';

        /**
         * Pages
         */
        include __DIR__ . '/pages.php';

        /**
         * Category
         */
        include __DIR__ . '/category.php';

        /**
         * Media
         */
        include __DIR__.'/media.php';

        include __DIR__ .'/courses.php';
    });
