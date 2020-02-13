<?php
/**
 * Local variables
 * @var Micro $app
 */

use Phalcon\Mvc\Micro;
use Phalcon\Events\Manager;
use Phalcon\Mvc\Micro\Collection as MicroCollection;
use Lackky\Auth\AuthenticationMiddleware;

$eventsManager = new Manager();
$eventsManager->attach('micro', new AuthenticationMiddleware());
$app->before(new AuthenticationMiddleware());
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
$user->post('/', 'createAction', 'reset_password');
$user->put('/{id}', 'updateAction');
$user->post('/avatar', 'avatarAction');
$user->get('/me', 'meAction');
$user->put('/password', 'passwordAction');
$user->get('/profile/{string}', 'profileAction');
$user->post('/reset_password', 'resetPasswordAction', 'resetPassword');
$user->post('/forgot_password', 'forgotPasswordAction');


$app->mount($user);

$auth = new MicroCollection();
$auth->setHandler(new Lackky\Controllers\AuthController());
$auth->setPrefix('/auth');
$auth->post('/', 'loginAction');
$auth->get('/check', 'check');
$app->mount($auth);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});

$app->setEventsManager($eventsManager);
