<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('component', function () {
            return require resource_path('views'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'config.php');
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        view()->composer('*', function($view) {
            $view->with('component_config',$this->app->make('component'));
        });
    }
}
