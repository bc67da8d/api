<?php
/**
 * Local variables
 * @var Micro $app
 */

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\Collection as MicroCollection;
use Phalcon\Events\Manager;
use Lackky\Auth\AuthenticationMiddleware;

$eventsManager = new Manager();
//$eventsManager->attach('micro', new AuthenticationMiddleware());
//$app->before(new AuthenticationMiddleware());
/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

$user = new MicroCollection();
$user->setHandler(new \Lackky\Controllers\UsersController());
$user->setPrefix('/users');
$user->post('/', 'createAction');
$user->put('/', 'updateAction');

$app->mount($user);
/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
