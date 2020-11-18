<?php

return [
    'route' => [
        'enabled' => true,
        'middleware' => ['web', 'auth'],
        'prefix' => 'master',
    ],
    'view' => [
        'layout' => 'ui::layouts.app',
    ],
    'menu' => [
        'enabled' => false,
    ],
];
