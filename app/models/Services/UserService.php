<?php


namespace Lackky\Models\Services;


use Lackky\Models\Services\Exceptions\EntityNotFoundException;
use Lackky\Models\Users;

class UserService extends Service
{
    public function create($data)
    {
        $user = new Users();
        $user->assign($data);
        $user->setPassword($this->security->hash($data['password']));
        $user->setCreatedAt(time());
        if (!$user->save()) {
            $this->logger->error($user->getMessages()[0]->getMessage());
            return false;
        }
        return $user;
    }

    /**
     * @param $email
     *
     * @return bool|\Phalcon\Mvc\ModelInterface|Users
     */
    public function findFirstByEmail($email)
    {
        $user = Users::query()
            ->where('email =:email:',['email' => $email])
            ->limit(1)
            ->execute();
        return $user->getFirst() ?: null;
    }
}