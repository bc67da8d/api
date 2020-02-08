<?php
/**
 * Local variables
 * @var Micro $app
 */

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

$user = new MicroCollection();
$user->setHandler(new Lackky\Controllers\UsersController());
$user->setPrefix('/users');
$user->get('/', 'indexAction');
$user->post('/', 'createAction');
$user->put('/{id}', 'updateAction');
$user->post('/avatar', 'avatarAction');
$user->get('/me', 'meAction');
$user->put('/password', 'passwordAction');
$user->get('/profile/{string}', 'profileAction');
$app->mount($user);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});

//$app->setEventsManager($eventsManager);