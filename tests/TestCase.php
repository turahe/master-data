<?php

namespace Turahe\Master\Test;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
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
            'Address' => \Turahe\Master\MasterFacade::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => 'tm_',
        ]);
        $app['config']->set('address.table_prefix', 'tm_');
    }
}
