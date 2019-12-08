<?php

/**
 * Registering an autoloader
 * @var $config
 */

use Phalcon\Loader;

$loader = new Loader();

$loader->registerNamespaces([
    'Lackky\Models'       => APP_PATH . '/models/',
    'Lackky\Controllers'  => APP_PATH . '/controllers/',
    'Lackky'              => APP_PATH . '/library/',
    'Lackky\Transformers' => APP_PATH . '/transformers'
]);
$loader->registerFiles([
    __DIR__ . '/helper.php',
]);
$loader->register();

require_once BASE_PATH . '/vendor/autoload.php';
