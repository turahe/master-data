<?php

$router->group(
    [
        'prefix' => 'master'
    ],
    function ($router) {
        $router->resource('provinces', \Turahe\Master\Http\Controllers\ProvinceController::class);
        $router->resource('cities', \Turahe\Master\Http\Controllers\CityController::class);
        $router->resource('districts', \Turahe\Master\Http\Controllers\DistrictController::class);
        $router->resource('Village', \Turahe\Master\Http\Controllers\VillageController::class);
        $router->resource('colors', \Turahe\Master\Http\Controllers\ColorController::class);
        $router->resource('timezones', \Turahe\Master\Http\Controllers\TimezoneController::class);
        $router->resource('currencies', \Turahe\Master\Http\Controllers\CurrencyController::class);
    }
);
