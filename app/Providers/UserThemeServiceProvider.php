<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Support\ServiceProvider;

class UserThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton('user_theme', function () {
            return new Controller();
        });
        $this->app->bind('themes_config', function () {
            return require resource_path('views'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.env('APP_THEMES').DIRECTORY_SEPARATOR.'config.php');
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        view()->composer('*', function ($view) {
            $view->with('user_theme', $this->app->make('user_theme'));
            $view->with('theme_config', $this->app->make('themes_config'));
        });
    }
}
