<?php

namespace App\Providers;

use App\Classes\Plugins\HookQueue;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use function PHPUnit\Framework\directoryExists;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /*
        |-----------------------------------------
        | Set Application Language
        |-----------------------------------------
        */

        //
        $this->app->singleton('hooks', function ($app) {
            return new HookQueue();
        });

        $pluginsFolders = (glob(app_path('Plugins/*'),GLOB_ONLYDIR));
        
        foreach ($pluginsFolders as $pluginPath) {
            if ( ! isset (config('plugins')[strtolower(basename($pluginPath))]) || config('plugins')[strtolower(basename($pluginPath))]['enable'] == false) {
                continue;
            }
            if (is_dir($pluginPath.DIRECTORY_SEPARATOR.'views') ) {
                $this->loadViewsFrom($pluginPath.DIRECTORY_SEPARATOR.'views', basename($pluginPath));
            }

            if (is_dir($pluginPath.DIRECTORY_SEPARATOR.'routes') ) {
                if (file_exists($pluginPath.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'web.php') ) {
                    $this->loadRoutesFrom($pluginPath.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'web.php');
                }
                if (file_exists($pluginPath.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'admin.php') ) {
                    $this->loadRoutesFrom($pluginPath.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'admin.php');
                }

                if (file_exists($pluginPath.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'web.php') ) {
                    $this->loadRoutesFrom($pluginPath.DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'web.php');
                }

                if (directoryExists($pluginPath.DIRECTORY_SEPARATOR.'database') && directoryExists($pluginPath.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations') ) {
                    $this->loadMigrationsFrom($pluginPath.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
                }
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
    }
}
