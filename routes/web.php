<?php

$router->group(
    [
        'prefix' => 'master',
        'middleware' => 'api'
    ],
    function ($router) {
        $router->get('villages', [\Turahe\Master\Http\Controllers\VillageController::class, 'index']);
        $router->post('villages', [\Turahe\Master\Http\Controllers\VillageController::class, 'store']);
        $router->get('villages/{id}', [\Turahe\Master\Http\Controllers\VillageController::class, 'show']);
        $router->patch('villages/{id}', [\Turahe\Master\Http\Controllers\VillageController::class, 'update']);
        $router->delete('villages/{id}', [\Turahe\Master\Http\Controllers\VillageController::class, 'destroy']);

        $router->get('districts', [\Turahe\Master\Http\Controllers\DistrictController::class, 'index']);
        $router->post('districts', [\Turahe\Master\Http\Controllers\DistrictController::class, 'store']);
        $router->get('districts/{id}', [\Turahe\Master\Http\Controllers\DistrictController::class, 'show']);
        $router->patch('districts/{id}', [\Turahe\Master\Http\Controllers\DistrictController::class, 'update']);
        $router->delete('districts/{id}', [\Turahe\Master\Http\Controllers\DistrictController::class, 'destroy']);

        $router->get('cities', [\Turahe\Master\Http\Controllers\CityController::class, 'index']);
        $router->post('cities', [\Turahe\Master\Http\Controllers\CityController::class, 'store']);
        $router->get('cities/{id}', [\Turahe\Master\Http\Controllers\CityController::class, 'show']);
        $router->patch('cities/{id}', [\Turahe\Master\Http\Controllers\CityController::class, 'update']);
        $router->delete('cities/{id}', [\Turahe\Master\Http\Controllers\CityController::class, 'destroy']);

        $router->get('states', [\Turahe\Master\Http\Controllers\StateController::class, 'index']);
        $router->post('states', [\Turahe\Master\Http\Controllers\StateController::class, 'store']);
        $router->get('states/{id}', [\Turahe\Master\Http\Controllers\StateController::class, 'show']);
        $router->patch('states/{id}', [\Turahe\Master\Http\Controllers\StateController::class, 'update']);
        $router->delete('states/{id}', [\Turahe\Master\Http\Controllers\StateController::class, 'destroy']);

        $router->get('provinces', [\Turahe\Master\Http\Controllers\StateController::class, 'index']);
        $router->post('provinces', [\Turahe\Master\Http\Controllers\StateController::class, 'store']);
        $router->get('provinces/{id}', [\Turahe\Master\Http\Controllers\StateController::class, 'show']);
        $router->patch('provinces/{id}', [\Turahe\Master\Http\Controllers\StateController::class, 'update']);
        $router->delete('provinces/{id}', [\Turahe\Master\Http\Controllers\StateController::class, 'destroy']);

        $router->get('countries', [\Turahe\Master\Http\Controllers\CountryController::class, 'index']);
        $router->post('countries', [\Turahe\Master\Http\Controllers\CountryController::class, 'store']);
        $router->get('countries/{id}', [\Turahe\Master\Http\Controllers\CountryController::class, 'show']);
        $router->patch('countries/{id}', [\Turahe\Master\Http\Controllers\CountryController::class, 'update']);
        $router->delete('countries/{id}', [\Turahe\Master\Http\Controllers\CountryController::class, 'destroy']);

        $router->get('currencies', [\Turahe\Master\Http\Controllers\CurrencyController::class, 'index']);
        $router->post('currencies', [\Turahe\Master\Http\Controllers\CurrencyController::class, 'store']);
        $router->get('currencies/{id}', [\Turahe\Master\Http\Controllers\CurrencyController::class, 'show']);
        $router->patch('currencies/{id}', [\Turahe\Master\Http\Controllers\CurrencyController::class, 'update']);
        $router->delete('currencies/{id}', [\Turahe\Master\Http\Controllers\CurrencyController::class, 'destroy']);

        $router->get('languages', [\Turahe\Master\Http\Controllers\LanguageController::class, 'index']);
        $router->post('languages', [\Turahe\Master\Http\Controllers\LanguageController::class, 'store']);
        $router->get('languages/{id}', [\Turahe\Master\Http\Controllers\LanguageController::class, 'show']);
        $router->patch('languages/{id}', [\Turahe\Master\Http\Controllers\LanguageController::class, 'update']);
        $router->delete('languages/{id}', [\Turahe\Master\Http\Controllers\LanguageController::class, 'destroy']);

        $router->get('banks', [\Turahe\Master\Http\Controllers\BankController::class, 'index']);
        $router->get('banks', [\Turahe\Master\Http\Controllers\BankController::class, 'store']);
        $router->get('banks/{id}', [\Turahe\Master\Http\Controllers\BankController::class, 'show']);
        $router->patch('banks/{id}', [\Turahe\Master\Http\Controllers\BankController::class, 'update']);
        $router->delete('banks/{id}', [\Turahe\Master\Http\Controllers\BankController::class, 'destroy']);

        $router->get('couriers', [\Turahe\Master\Http\Controllers\CourierController::class, 'index']);
        $router->post('couriers', [\Turahe\Master\Http\Controllers\CourierController::class, 'store']);
        $router->get('couriers/{id}', [\Turahe\Master\Http\Controllers\CourierController::class, 'show']);
        $router->patch('couriers/{id}', [\Turahe\Master\Http\Controllers\CourierController::class, 'update']);
        $router->delete('couriers/{id}', [\Turahe\Master\Http\Controllers\CourierController::class, 'destroy']);

        $router->get('colors', [\Turahe\Master\Http\Controllers\ColorController::class, 'index']);
    }
);
