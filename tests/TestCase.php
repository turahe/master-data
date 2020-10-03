<?php

namespace Turahe\Address\Test;

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
            \Turahe\Address\ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Address' => \Turahe\Address\Facade::class,
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
