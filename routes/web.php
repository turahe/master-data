<?php

$router->group(
    [
        'namespace' => '\Turahe\Master\Http\Controllers',
        'prefix' => config('master-data.route.prefix'),
        'as' => 'master::',
        'middleware' => config('master-data.route.middleware'),
    ],
    function ($router) {
        $router->get('villages', \Turahe\Master\Http\Controllers\VillageController::class);
        $router->get('districts', \Turahe\Master\Http\Controllers\DistrictController::class);
        $router->get('cities', \Turahe\Master\Http\Controllers\CityController::class);
        $router->get('states', \Turahe\Master\Http\Controllers\StateController::class);
        $router->get('provinces', \Turahe\Master\Http\Controllers\StateController::class);
        $router->get('countries', \Turahe\Master\Http\Controllers\CountryController::class);
        $router->get('currencies', \Turahe\Master\Http\Controllers\CurrencyController::class);
        $router->get('languages', \Turahe\Master\Http\Controllers\LanguageController::class);
        $router->get('banks', \Turahe\Master\Http\Controllers\BankController::class);
        $router->get('couriers', \Turahe\Master\Http\Controllers\CourierController::class);
        $router->get('colors', \Turahe\Master\Http\Controllers\ColorController::class);
    }
);
