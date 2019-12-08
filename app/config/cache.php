<?php
use Phalcon\Config;

/**
 * Improving Performance with Cache
 *
 * @link https://docs.phalconphp.com/en/latest/reference/cache.html
 */
return new Config([
    'default' => env('CACHE_DRIVER', 'file'),
    'drivers' => [
        'apc' => [
            'adapter' => 'Apc',
        ],
        'memcache' => [
            'adapter' => 'Memcache',
            'host'    => env('MEMCACHED_HOST', '127.0.0.1'),
            'port'    => env('MEMCACHED_PORT', 11211),
        ],
        'memcached' => [
            'adapter' => 'Libmemcached',
            'servers' => [
                [
                    'host'   => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port'   => env('MEMCACHED_PORT', 11211),
                    'weight' => env('MEMCACHED_WEIGHT', 100),
                ],
            ],
        ],
        'file' => [
            'adapter'  => 'File',
            'cacheDir' => app_path('var/cache/data/')
        ],

        'redis' => [
            'adapter' => 'Redis',
            'host'    => env('REDIS_HOST', '127.0.0.1'),
            'port'    => env('REDIS_PORT', 6379),
            'index'   => env('REDIS_INDEX', 0),
        ],

        'memory' => [
            'adapter' => 'Memory',
        ],
    ],

    'prefix' => env('CACHE_PREFIX', 'api_'),

    'lifetime' => env('CACHE_LIFETIME', 86400),
]);
