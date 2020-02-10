<?php
use Phalcon\Config;

return new Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => env('DB_HOST'),
        'username' => env('DB_USER'),
        'password' => env('DB_PASSWORD'),
        'dbname' => env('DB_NAME'),
        'charset' => 'utf8',
    ],

    'application' => [
        'domain' => env('DOMAIN', 'https://api.lackky.com'),
        'viewsDir' => APP_PATH . '/views/',
        'baseUri' => '/',
        'jwtSecret' => env('JWT_SECRET', '12345$%Qawesome'),
        'debug' => env('DEBUG', false),
        'cookieLifetime' => env('COOKIE_LIFETIME', 31536000),
    ],
    'mail' => [
        'templatesDir' => 'mail/',
        'fromName'     => 'Lackky',
        'fromEmail'    => 'no-reply@lackky.com',
        'smtp'         => [
            'server'   => env('MAIL_SERVER'),
            'port'     => '587',
            'security' => 'tls',
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
        ]
    ],
]);
