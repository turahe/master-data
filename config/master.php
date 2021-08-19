<?php

return [
    'route' => [
        'enabled' => true,
        'middleware' => ['web'],
        'prefix' => 'master',
    ],
    'view' => [
        'layout' => 'ui::layouts.app',
    ],
    'menu' => [
        'enabled' => false,
    ],

    /*
  * The name of the column that will be used to sort models.
  */
    'order_column_name' => 'order_column',

    /*
     * Define if the models should sort when creating. When true, the package
     * will automatically assign the highest order number to a new model
     */
    'sort_when_creating' => true,
];
