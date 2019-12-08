<?php

use Lackky\Aws\Storage;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Cache\Frontend\Data;
use Lackky\Auth\Auth;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * Sets the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    return $view;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        'charset' => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});

$di->set('dispatcher', function () use ($di) {
        $eventsManager = new EventsManager;
        //$eventsManager->attach('dispatch', new Acl());
        //$eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
        $dispatcher = new Dispatcher;
        $dispatcher->setEventsManager($eventsManager);
        $dispatcher->setDefaultNamespace('Lackky\\Controllers');
        return $dispatcher;
});

$di->setShared('modelsManager', function () {
        return new ModelsManager();
});

$di->setShared('storage', function () {
    return new Storage();
});
$di->setShared('logger', function () {
    $logger = app_path('var/logs/') . date('Y-m-d') . '.log';
    return new FileAdapter($logger, ['model' => 'a+']);
});
$di->setShared('modelsCache', function () {
    $config = include config_path('cache.php');
    $config = $config->toArray();
    $driver = $config['default'];
    $driverConfig['config'] = $config['drivers'][$driver];
    $driverConfig['lifetime'] = $config['lifetime'];
    $driverConfig['prefix'] = $config['prefix'];
    $adapter = '\Phalcon\Cache\Backend\\' . $driverConfig['config']['adapter'];
    unset($driverConfig['config']['adapter']);
    $driverConfig['config']['prefix'] = $driverConfig['prefix'];
    return new $adapter(
        new Data(['lifetime' => $driverConfig['lifetime']]),
        $driverConfig['config']
    );
});
$di->setShared('auth', function () {
    return new Auth();
});
