<?php

namespace Turahe\Master;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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
        $this->mergeConfigFrom(__DIR__ . '/../config/master.php', 'turahe.master');

        $databasePath = __DIR__.'/../database/migrations';
        if ($this->isLumen()) {
            $this->loadMigrationsFrom($databasePath);
        } else {
            $this->publishes([$databasePath => database_path('migrations')], 'migrations');
        }

        if (class_exists(Application::class)) {
            $this->publishes(
                [
                    __DIR__ . '/../config/master.php' => config_path('turahe/master.php'),
                ],
                'config'
            );
        }

        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views'), 'master');

        if (config('turahe.master.route.enabled')) {
            $this->registerRoutes();
        }

        if (config('turahe.master.menu.enabled')) {
            $this->registerMenu();
        }

        if ($this->app->bound('turahe.acl')) {
            $this->app['turahe.acl']->registerPermission(Permission::toArray());
        }

        $this->registerMacro();
    }

    protected function registerMenu()
    {
        if ($this->app->bound('turahe.menu')) {
            $menu = app('turahe.menu')->add('Data Wilayah');
            $menu->add(__('Province'), route('master::provinces.index'))
                ->data('icon', 'map')
                ->data('permission', Permission::MANAGE_INDONESIA)
                ->active(config('turahe.master.route.prefix').'/provinces/*');
            $menu->add(__('Kota/City'), route('master::cities.index'))
                ->data('icon', 'map marker')
                ->data('permission', Permission::MANAGE_INDONESIA)
                ->active(config('turahe.master.route.prefix').'/cities/*');
            $menu->add(__('District'), route('master::districts.index'))
                ->data('icon', 'map marker alternate')
                ->data('permission', Permission::MANAGE_INDONESIA)
                ->active(config('turahe.master.route.prefix').'/districts/*');
            $menu->add(__('Desa/Village'), route('master::villages.index'))
                ->data('icon', 'map pin')
                ->data('permission', Permission::MANAGE_INDONESIA)
                ->active(config('turahe.master.route.prefix').'/villages/*');
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
