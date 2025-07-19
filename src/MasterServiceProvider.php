<?php

namespace Turahe\Master;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Turahe\Master\Commands\SeedCommand;
use Turahe\Master\Commands\SyncCoordinateCommand;

class MasterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->commands([
            SeedCommand::class,
            SyncCoordinateCommand::class,
        ]);

        $this->app->singleton('master', function ($app) {
            return new \Turahe\Master\MasterManager($app);
        });
    }

    /**
     * for lumen version <=5.2, just copy the migrations from the package directory.
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/master.php', 'master');

        $databasePath = __DIR__.'/../database/migrations';
        $this->loadMigrationsFrom($databasePath);

        if (class_exists(Application::class)) {
            $this->publishes(
                [
                    __DIR__.'/../config/master.php' => config_path('master.php'),
                ],
                'config'
            );

            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/assets'),
            ], 'assets');
        }
    }
}
