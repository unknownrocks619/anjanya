<?php

use App\Http\Controllers\Admin\User\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::match(['post', 'get'], '/logout', [AdminLoginController::class, 'logout'])
            ->name('logout');

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
         * Settings
         */
        include __DIR__ . '/settings.php';
    });
