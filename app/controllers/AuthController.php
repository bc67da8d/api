<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Controllers;

use Lackky\Auth\Auth;
use Lackky\Models\Services\UserService;
use Firebase\JWT\JWT;
use Exception;

/**
 * Class AuthController
 *
 * @property Auth $auth
 * @package App\Controllers
 */
class AuthController extends ControllerBase
{

    /**
     * @var UserService
     */
    protected $userService;

    public function onConstruct()
    {
        $this->userService = new UserService();
    }

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function loginAction()
    {
        $data = $this->parserDataRequest();
        if (!isset($data['password']) || !isset($data['email'])) {
            return $this->respondWithError('You need provider email and password');
        }
        try {
            $user = $this->auth->check($data);
            return $this->respondWithArray($this->userService->createJwtToken($user));
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            return $this->respondWithError($e->getMessage());
        }
    }
}
