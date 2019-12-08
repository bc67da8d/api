<?php
namespace Lackky\Controllers;

use Lackky\Models\Services\UserService;
use Firebase\JWT\JWT;

/**
 * Class AuthController
 *
 * @package Lackky\Controllers
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
        $parameter = $this->parserDataRequest();
        if (!isset($parameter['emailOrUsername'])) {
            return $this->respondWithError('You need provider email and password');
        }

        $user = $this->userService->findFirstByEmailOrUsername($parameter['emailOrUsername']);
        if (!$user) {
            return $this->respondWithError('This username or email do not exist');
        }
        if (!$this->security->checkHash($parameter['password'], $user->getPassword())) {
            return $this->respondWithError('Wrong password combination');
        }
        $key = base64_decode($this->config->application->jwtSecret);
        $time = time();
        $expiresIn = $time + env('EXPIRES_TOKEN');
        $token = [
            'iss' =>  $this->request->getURI(),
            'iat' =>  $time,
            'exp' =>  $expiresIn,
            'data' =>[
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
            ]
        ];
        $jwt = JWT::encode($token, $key);
        return $this->respondWithArray([
            'message' => 'Successful Login',
            'token' => $jwt,
            'expiresIn' => $expiresIn
        ]);
    }
}
