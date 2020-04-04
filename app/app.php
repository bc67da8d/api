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
$user->post('/', 'createAction');
$user->put('/', 'updateAction');
$user->post('/avatar', 'avatarAction');
$user->get('/me', 'meAction');
$user->put('/password', 'passwordAction');
$user->get('/profile/{string}', 'profileAction');
$user->post('/reset_password', 'resetPasswordAction');
$user->post('/forgot_password', 'forgotPasswordAction');
$app->mount($user);

$auth = new MicroCollection();
$auth->setHandler(new Lackky\Controllers\AuthController());
$auth->setPrefix('/auth');
$auth->post('/', 'loginAction');
$auth->get('/check', 'check');
$app->mount($auth);

$post = new MicroCollection();
$post->setHandler(new Lackky\Controllers\PostsController());
$post->setPrefix('/posts');
$post->get('/', 'indexAction');
$post->post('/', 'createAction');
$post->put('/{id:[0-9]+}', 'updateAction');
$post->delete('/{id:[0-9]+}', 'deleteAction');
$app->mount($post);

$cart = new MicroCollection();
$cart->setHandler(new Lackky\Controllers\PostsController());
$cart->setPrefix('/posts');
$cart->get('/', 'indexAction');
$cart>post('/', 'createAction');
$cart->put('/{id:[0-9]+}', 'updateAction');
$cart->delete('/{id:[0-9]+}', 'deleteAction');
$app->mount($cart);

$product = new MicroCollection();
$product->setHandler(new Lackky\Controllers\ProductsController());
$product->setPrefix('/products');
$product->get('/', 'indexAction');
$product->post('/', 'createAction');
$product->put('/{id:[0-9]+}', 'updateAction');
$product->delete('/{id:[0-9]+}', 'deleteAction');
$app->mount($product);

$upload = new MicroCollection();
$upload->setHandler(new Lackky\Controllers\UploadsController());
$upload->setPrefix('/uploads');
$upload->get('/', 'indexAction');
$upload->post('/', 'createAction');
$upload->post('/{id}', 'updateAction');
$app->mount($upload);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});

$app->setEventsManager($eventsManager);
