<?php

use App\Http\Controllers\Admin\User\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::match(['post', 'get'], '/logout', [AdminLoginController::class, 'logout'])
            ->name('logout');

        Route::match(['post','get'],'codetest',[\App\Http\Controllers\Test\CodeTestZone::class,'index'])->name('code-test');
        /**
         * Component
         */
        include __DIR__ . '/components.php';

        /**
         * Plugins
         */
        include __DIR__ . '/connector.php';

        /**
         * SEO
         */

        include __DIR__ . '/seo.php';

        /**
         * Media
         */
        include __DIR__ . '/media.php';

        /**
         * Dashboard
         */
        include __DIR__ . '/dashboard.php';

        /**
         * Users
         */
        include __DIR__ . '/users.php';

        /**
         * Organisation
         */
        include __DIR__ . '/organisation.php';

        /**
         * Organisation Student
         */

        include __DIR__ . '/organisation_student.php';

        /**
         * Menus
         */

        include __DIR__ . '/menu.php';

        /**
         * Page
         */
        include __DIR__ . '/page.php';

        /**
         * Post
         */
        include __DIR__ . '/post.php';
        /**
         * Categories
         */
        include __DIR__ . '/categories.php';

        /**
         * Gallery Albums & Items
         */
        include __DIR__.'/gallery.php';

        /**
         * Courses
         */

        include __DIR__ . '/courses.php';

        /**
         * sort
         */
        include __DIR__ . '/sort.php';

        /**
         * Book
         */
        include __DIR__ . '/book.php';

        /**
         * Products / Ecommerce
         */
        include __DIR__ . '/ecommerce.php';

        /**
         * Select2 Element
         */
        include __DIR__ . '/select2.php';

        /**
         * Gallery Slider
         */
        include __DIR__ . '/slider.php';

        /**
         * Settings
         */
        include __DIR__ . '/settings.php';

        /**
         * Admin
         */
        include __DIR__ . '/account.php';

        /**
         * Themes
         */
        include __DIR__.'/theme.php';

    });
