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
use Lackky\Aws\Storage;
use Lackky\Mail\Mailer;
use Lackky\Models\Services\UserService;
use Firebase\JWT\JWT;
use Exception;
use Lackky\Models\Users;
use Lackky\Transformers\UsersTransformer;
use Lackky\Validation\AvatarUserValidation;
use Lackky\Validation\UserValidation;

/**
 * Class UsersController
 * @property Mailer  $mail
 * @property Storage $storage
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
    public function avatarAction()
    {
        if (!$userId = $this->auth->getUserId()) {
            return $this->respondWithError('You need login to update avatar');
        }
        $validation = $this->validation(AvatarUserValidation::class, $_FILES);
        if ($validation) {
            return  $this->respondWithError($validation, 404);
        }
        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles();
            // Move the file into the application
            // For best practice we should put this action in queue
            if (!$upload= $this->storage->uploadAvatar($files[0])) {
                return $this->respondWithError('Update avatar not success');
            }
            $user = $this->userService->findFirstById($userId);
            if (!$user) {
                return $this->respondWithError('Unauthorized');
            }

            if (is_array($upload) && isset($upload['error'])) {
                return $this->respondWithArray($upload);
            }
            $user->setAvatar($upload->getId());
            $user->save();
            return $this->respondWithItem($user, new UsersTransformer());
        }
        return $this->respondWithError('Update avatar not success');
    }
    public function forgotPasswordAction()
    {
        $data = $this->parserDataRequest();
        $email = $data['email'] ?? null;
        if (!$user = $this->userService->findFirstByEmail($email)) {
            return $this->respondWithError('Something wrong to reset password');
        }

        $passwordForgotHash = sha1('forgot' . microtime());
        $user->setPasswordForgotHash($passwordForgotHash);
        if (!$user->save()) {
            $this->logger->error($user->getMessages()[0]->getMessage());
            return $this->respondWithError('Something wrong to reset password');
        }
        $params = [
            'link' => $this->config->application->domain . '/users/reset_password?hash=' . $passwordForgotHash,
            'name'  => $user->getName(),
            'email'     => $email,
            'subject'   => 'Reset your Lackky password'
        ];
        if (!$this->mail->send($email, 'resetpassword', $params)) {
            return $this->respondWithError('Something wrong to sent reset password');
        }
        return $this->respondWithSuccess('Notification sent');
    }
    public function resetPasswordAction()
    {
        $data = $this->parserDataRequest();
        $parameter = $this->getParameter();
        $hash = $parameter['hash'] ?? null;
        $user = $this->userService->findFirstByPasswordForgotHash($hash);
        if (!$user || !isset($data['password'])) {
            return $this->respondWithError('Something wrong to reset password');
        }
        $user->setPasswordForgotHash(null);
        $user->setPassword($this->security->hash($data['password']));
        $user->setUpdatedAt(time());
        $user->save();
        return $this->respondWithArray($this->userService->createJwtToken($user));
    }
}
