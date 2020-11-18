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
            'Master' => \Turahe\Master\MasterData::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}
