<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
use Phalcon\Loader;
use Dotenv\Dotenv;

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

$dotenv = Dotenv::create(realpath(BASE_PATH));
$dotenv->load();