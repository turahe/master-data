<?php

namespace Turahe\Master\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Turahe\Master\Tests\Models\Dummy;
use Turahe\Master\Tests\Models\User;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->setUpDatabase();
    }

    protected function getPackageProviders($app)
    {
        return [
            \Turahe\Master\MasterServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Master' => \Turahe\Master\MasterFacade::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('app.key', 'base64:MFOsOH9RomiI2LRdgP4hIeoQJ5nyBhdABdH77UY2zi8=');
    }

    protected function setUpDatabase()
    {
        Config::set('master.users_model', User::class);

        $this->app['db']->connection()->getSchemaBuilder()->create('dummies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('custom_column_sort');
            $table->integer('record_ordering');
        });

        collect(range(1, 20))->each(function (int $i) {
            Dummy::create([
                'name' => $i,
                'custom_column_sort' => rand(),
            ]);
        });

        $this->app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();

            $table->timestamps();
        });

        $this->app['db']->connection()->getSchemaBuilder()->create('userstamps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->timestamps();
            $table->softDeletes();

            $table->userStamps();
            $table->softUserStamps();
        });
    }

    protected function setUpSoftDeletes()
    {
        $this->app['db']->connection()->getSchemaBuilder()->table('dummies', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
