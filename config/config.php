<?php



return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Meilisearch Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to disable Laravel Meilisearch
    |
    */

    'enabled' => env('LARAVEL_MEILISEARCH_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Laravel Meilisearch Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Laravel Meilisearch will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'path' => env('LARAVEL_MEILISEARCH_PATH', 'laravel-meilisearch'),

    /*
    |--------------------------------------------------------------------------
    | Laravel Meilisearch Storage Driver
    |--------------------------------------------------------------------------
    |
    | This configuration options determines the storage driver that will
    | be used to store Laravel Meilisearch's data. In addition, you may set any
    | custom options as needed by the particular driver you choose.
    |
    */

    'driver' => env('LARAVEL_MEILISEARCH_DRIVER', 'database'),

    'storage' => [
        'database' => [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'chunk' => 1000,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Meilisearch Queue
    |--------------------------------------------------------------------------
    |
    | This configuration options determines the queue connection and queue
    | which will be used to process ProcessPendingUpdate jobs. This can
    | be changed if you would prefer to use a non-default connection.
    |
    */

    'queue' => [
        'connection' => env('LARAVEL_MEILISEARCH_QUEUE_CONNECTION', null),
        'queue' => env('LARAVEL_MEILISEARCH_QUEUE', null),
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Meilisearch Settings
    |--------------------------------------------------------------------------
    |
    | The following array lists the Settings. Feel free to customize this list.
    |
    */

    'host' => env('MEILISEARCH_HOST', 'https://se-dev.lifepharmacy.com'),
    'key' => env('MEILISEARCH_KEY', 'Y0urVery-S3cureAp1K3y'),

];
