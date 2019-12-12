<?php
namespace Lackky\Controllers;

use Lackky\Models\Services\UserService;
use Firebase\JWT\JWT;
use Lackky\Models\Users;
use Lackky\Validation\UserValidation;

class UsersController extends ControllerBase
{
    /**
     * @var UserService
     */
    protected $userService;

    public function onConstruct()
    {
        $this->userService = new UserService();

    }
    public function createAction()
    {
        //validate
        $data = $this->parserDataRequest();
        $message = $this->validation(UserValidation::class, $data);
        if ($message) {
            return $this->respondWithError($message);
        }
        if ($this->userService->findFirstByEmail($data['email'])) {
            return $this->respondWithError('The email have exits');
        }
        if (!$user = $this->userService->create($data)) {
            return $this->respondWithError('Something wrong create a user');
        }
        return $this->respondWithSuccess($user->toArray());
    }
    public function updateAction()
    {
        //$user = $this->userService->findFirstByEmail($data['email'])
        //
    }
}
