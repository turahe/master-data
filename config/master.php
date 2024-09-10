<?php

return [
    /*
  |--------------------------------------------------------------------------
  | Subscription Tables
  |--------------------------------------------------------------------------
  |
  |
  */
    'tables' => [
        'countries' => 'tm_countries',
        'provinces' => 'tm_provinces',
        'cities' => 'tm_cities',
        'districts' => 'tm_districts',
        'villages' => 'tm_villages',
        'banks' => 'tm_banks',
        'currencies' => 'tm_currencies',
        'languages' => 'tm_languages',
    ],
    /*
    |--------------------------------------------------------------------------
    | Master Data Models
    |--------------------------------------------------------------------------
    |
    | Models used to manage master data. You can replace to use your own models,
    | but make sure that you have the same functionalities or that your models
    | extend from each model that you are going to replace.
    |
    */
    'models' => [
        'country' => \Turahe\Master\Models\Country::class,
        'province' => \Turahe\Master\Models\Province::class,
        'city' => \Turahe\Master\Models\City::class,
        'district' => \Turahe\Master\Models\District::class,
        'village' => \Turahe\Master\Models\Village::class,
    ],

];
