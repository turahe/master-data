<?php

namespace Turahe\Master\Test;

use Illuminate\Database\Schema\Blueprint;
use Turahe\Master\Test\Models\Dummy;

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
            'Master' => \Turahe\Master\MasterData::class,
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
    }

    protected function setUpDatabase()
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('dummies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('custom_column_sort');
            $table->integer('order_column');
        });

        collect(range(1, 20))->each(function (int $i) {
            Dummy::create([
                'name' => $i,
                'custom_column_sort' => rand(),
            ]);
        });
    }

    protected function setUpSoftDeletes()
    {
        $this->app['db']->connection()->getSchemaBuilder()->table('dummies', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
