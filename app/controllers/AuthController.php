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
        $data = $this->parserDataRequest();
        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->respondWithError(t('You need provide email or password'));
        }
        $user = $this->userService->findFirstByEmail($data['email']);
        if (!$user) {
            return $this->respondWithError('The email have not exits!');
        }
        if (!$this->security->checkHash($data['password'], $user->getPassword())) {
            return $this->respondWithError('The password input wrong!');
        }
        $auth = container('auth');
        try {
            if (!$auth->check($data)) {
                $key  = $this->config->application->jwtSecret;
                $time = time();
                $expiresIn = $time + env('EXPIRES_TOKEN');
                $token = [
                    'iss' =>  $this->request->getURI(),
                    'iat' =>  $time,
                    'exp' =>  $expiresIn,
                    'data' =>[
                        'id' => $user->getId(),
                        'email' => $user->getEmail(),
                    ]
                ];
                $jwt = JWT::encode($token, $key);
                return $this->respondWithArray([
                    'message' => 'Successful Login',
                    'token' => $jwt,
                    'expiresIn' => $expiresIn
                ]);
            }
        } catch (\Exception $e) {

            return $this->errorForbidden($e->getMessage());
        }

    }
}
