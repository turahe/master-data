<?php

$router->group(
    [
        'namespace' => '\Turahe\Address\Http\Controllers',
        'prefix' => config('turahe.address.route.prefix'),
        'as' => 'address::',
        'middleware' => config('turahe.address.route.middleware'),
    ],
    function ($router) {
        $router->resource('provinces', 'ProvinceController');
        $router->resource('cities', 'CityController');
        $router->resource('districts', 'DistrictController');
        $router->resource('Village', 'VillageController');
    }
);
