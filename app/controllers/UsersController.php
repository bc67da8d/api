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
use Lackky\Transformers\UsersTransformer;
use Lackky\Validation\UserValidation;

/**
 * Class UsersController
 *
 * @package Lackky\Controllers
 */
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
        $data = $this->parserDataRequest();
        $validation = $this->validation(UserValidation::class, $data);
        if ($validation) {
            return $this->respondWithError($validation);
        }
        if ($this->userService->findFirstByEmail($data['email'])) {
            return $this->respondWithError('That email is taken. Try another');
        }
        if (!$user = $this->userService->create($data)) {
            return $this->respondWithError('Add user fail');
        }

        return $this->respondWithItem($user, new UsersTransformer());
    }
}
