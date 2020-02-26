<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Auth;

use Firebase\JWT\JWT;
use Phalcon\Mvc\Micro;
use Phalcon\Events\Event;
use Phalcon\Mvc\Micro\MiddlewareInterface;

/**
 * Class AuthenticationMiddleware
 *
 */
class AuthenticationMiddleware implements MiddlewareInterface
{

    public function beforeHandleRoute(Event $event, Micro $app)
    {
        //@TODO
    }

    /**
     * @param Event $event
     * @param Micro $app
     *
     * @return bool
     */
    public function beforeExecuteRoute(Event $event, Micro $app)
    {
        $authHeader= $app->request->getHeader('Authorization');
        if ($authHeader) {
            $jwt = explode(" ", $authHeader);
            $key = $app['config']->application->jwtSecret;
            if (isset($jwt[1])) {
                try {
                    $decoded = JWT::decode($jwt[1], $key, ['HS256']);
                    // @TODO verify
                    $app->setService('auth', function () use ($decoded) {
                        return new Auth($decoded);
                    });
                } catch (\Exception $e) {
                    return $this->sendError($app);
                }
            }
        } else {
            if ($this->apiKey($app)) {
                return true;
            }
            return $this->sendError($app);
        }
    }

    /**
     * Call me
     *
     * @param Micro $api
     *
     * @return bool
     */
    public function call(Micro $api)
    {
        return true;
    }
    /**
     * @param Micro $app
     *
     * @return bool
     */
    protected function apiKey(Micro $app)
    {
        $config = require config_path('apikey.php');
        $env = env('APPLICATION_ENV', 'prod');
        if (in_array($app->request->get('key'), $config[$env])) {
            return true;
        }
        return false;
    }
    protected function sendError($app)
    {
        $data = [
            'code'    => 404,
            'status'  => 'error',
            'message' => 'Unauthorized access',
            'payload' => [],
        ];
        $app->response->setJsonContent($data);
        $app->response->send();
        return false;
    }
}
