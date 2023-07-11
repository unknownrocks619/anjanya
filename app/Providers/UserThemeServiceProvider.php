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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        view()->composer('*', function ($view) {
            $view->with('user_theme', $this->app->make('user_theme'));
        });
    }
}
