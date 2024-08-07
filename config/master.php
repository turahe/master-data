<?php

return [
    'route'                      => [
        'enabled'    => true,
        'middleware' => ['web'],
        'prefix'     => 'master',
    ],
    'view'                       => [
        'layout' => 'master::layouts.app',
    ],
    'menu'                       => [
        'enabled' => false,
    ],
    'migration'                  => [
        'enable' => true,
    ],

    /*
     * Define if the models should sort when creating. When true, the package
     * will automatically assign the highest order number to a new model
     */
    'sort_when_creating'         => true,
    
    'tables' => [
        'countries' => 'tm_countries',
    ] 
];
