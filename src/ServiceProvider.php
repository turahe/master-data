<?php

namespace Turahe\Address;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Str;
use Turahe\Address\Commands\SeedCommand;
use Turahe\Address\Commands\SyncCoordinateCommand;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->bind('indonesia', function () {
            return new AddressService();
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
        $this->mergeConfigFrom(__DIR__ . '/../config/address.php', 'laravolt.indonesia');

        $databasePath = __DIR__.'/../database/migrations';
        if ($this->isLumen()) {
            $this->loadMigrationsFrom($databasePath);
        } else {
            $this->publishes([$databasePath => database_path('migrations')], 'migrations');
        }

        if (class_exists(Application::class)) {
            $this->publishes(
                [
                    __DIR__ . '/../config/address.php' => config_path('laravolt/address.php'),
                ],
                'config'
            );
        }

        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views'), 'indonesia');

        if (config('laravolt.indonesia.route.enabled')) {
            $this->registerRoutes();
        }

        if (config('laravolt.indonesia.menu.enabled')) {
            $this->registerMenu();
        }

        if ($this->app->bound('laravolt.acl')) {
            $this->app['laravolt.acl']->registerPermission(Permission::toArray());
        }

        $this->registerMacro();
    }

    protected function registerMenu()
    {
        if ($this->app->bound('laravolt.menu')) {
            $menu = app('laravolt.menu')->add('Data Wilayah');
            $menu->add(__('Province'), route('indonesia::provinsi.index'))
                ->data('icon', 'map')
                ->data('permission', Permission::MANAGE_INDONESIA)
                ->active(config('laravolt.indonesia.route.prefix').'/provinsi/*');
            $menu->add(__('Kota/City'), route('indonesia::kabupaten.index'))
                ->data('icon', 'map marker')
                ->data('permission', Permission::MANAGE_INDONESIA)
                ->active(config('laravolt.indonesia.route.prefix').'/kabupaten/*');
            $menu->add(__('District'), route('indonesia::kecamatan.index'))
                ->data('icon', 'map marker alternate')
                ->data('permission', Permission::MANAGE_INDONESIA)
                ->active(config('laravolt.indonesia.route.prefix').'/kecamatan/*');
            $menu->add(__('Desa/Village'), route('indonesia::kelurahan.index'))
                ->data('icon', 'map pin')
                ->data('permission', Permission::MANAGE_INDONESIA)
                ->active(config('laravolt.indonesia.route.prefix').'/kelurahan/*');
        }
    }

    protected function registerMacro()
    {
        EloquentBuilder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (EloquentBuilder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (EloquentBuilder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas(
                                $relationName,
                                function (EloquentBuilder $query) use ($relationAttribute, $searchTerm) {
                                    $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                                }
                            );
                        },
                        function (EloquentBuilder $query) use ($attribute, $searchTerm) {
                            $table = $query->getModel()->getTable();
                            $query->orWhere(sprintf('%s.%s', $table, $attribute), 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });
    }

    protected function registerRoutes()
    {
        $router = $this->app['router'];
        require __DIR__.'/../routes/web.php';
    }

    protected function isLaravel()
    {
        return app() instanceof \Illuminate\Foundation\Application;
    }

    protected function isLumen()
    {
        return !$this->isLaravel();
    }
}
