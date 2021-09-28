<?php

return [
    'route' => [
        'enabled' => true,
        'middleware' => ['web'],
        'prefix' => 'master',
    ],
    'view' => [
        'layout' => 'master::layouts.app',
    ],
    'menu' => [
        'enabled' => false,
    ],

    /*
     * Define the table which is used in the database to retrieve the users
     */

    'users_table' => 'users',

    /*
     * Define the table column type which is used in the table schema for
     * the id of the user
     *
     * Options: increments, bigIncrements, uuid
     * Default: bigIncrements
     */

    'users_table_column_type' => 'bigIncrements',

    /*
     * Define the name of the column which is used in the foreign key reference
     * to the id of the user
     */

    'users_table_column_id_name' => 'id',

    /*
     * Define the model which is used for the relationships on your models
     */

    'users_model' => \App\Models\User::class,

    /*
     * Define the column which is used in the database to save the user's id
     * which created the model.
     */

    'created_by_column' => 'created_by',

    /*
     * Define the column which is used in the database to save the user's id
     * which updated the model.
     */

    'updated_by_column' => 'updated_by',

    /*
     * Define the column which is used in the database to save the user's id
     * which deleted the model.
     */

    'deleted_by_column' => 'deleted_by',

    /*
  * The name of the column that will be used to sort models.
  */
    'record_ordering_name' => 'record_ordering',

    /*
     * Define if the models should sort when creating. When true, the package
     * will automatically assign the highest order number to a new model
     */
    'sort_when_creating' => true,
    
];
