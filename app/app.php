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
$eventsManager->attach('micro', new AuthenticationMiddleware());
$app->before(new AuthenticationMiddleware());
/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

$users = new MicroCollection();
$users->setHandler(new Lackky\Controllers\UsersController());
$users->setPrefix('/users');
$users->get('/', 'indexAction');
$users->post('/', 'createAction');
$users->put('/{id}', 'updateAction');
$users->post('/avatar', 'avatarAction');
$users->get('/me', 'meAction');
$users->put('/password', 'passwordAction');
$users->get('/profile/{string}', 'profileAction');
$app->mount($users);

$auth = new MicroCollection();
$auth->setHandler(new Lackky\Controllers\AuthController());
$auth->setPrefix('/auth');
$auth->post('/', 'loginAction');
$auth->get('/check', 'check');
$app->mount($auth);

$upload = new MicroCollection();
$upload->setHandler(new Lackky\Controllers\UploadsController());
$upload->setPrefix('/uploads');
$upload->get('/', 'indexAction');
$upload->post('/', 'createAction');
$upload->post('/{id}', 'updateAction');
$app->mount($upload);

$post = new MicroCollection();
$post->setHandler(new Lackky\Controllers\PostsController());
$post->setPrefix('/posts');
$post->get('/', 'indexAction');
$post->post('/', 'createAction');
$post->get('/{id}', 'viewAction');
$post->post('/{id}', 'updateAction');
$app->mount($post);


/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
