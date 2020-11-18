<?php

namespace Turahe\Master;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Turahe\Master\Commands\SeedCommand;
use Turahe\Master\Commands\SyncCoordinateCommand;

class MasterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('master', function () {
            return new MasterService();
        });

        $this->commands([
            SeedCommand::class,
            SyncCoordinateCommand::class,
        ]);
    }

    /*
        for lumen version <=5.2, just copy the migrations from the package directory
    */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/master.php', 'master-data');

        $databasePath = __DIR__.'/../database/migrations';
        $this->loadMigrationsFrom($databasePath);

        if (class_exists(Application::class)) {
            $this->publishes(
                [
                    __DIR__.'/../config/master.php' => config_path('master-data.php'),
                ],
                'config'
            );
        }

        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views'), 'master');

        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        $router = $this->app['router'];
        require __DIR__.'/../routes/web.php';
    }
}
