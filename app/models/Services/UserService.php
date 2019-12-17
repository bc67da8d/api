<?php


namespace Lackky\Models\Services;


use Lackky\Constants\UserConstant;
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
    public function update($data)
    {
        unset($data['password']);
        unset($data['email']);
        $user = $this->findFirstById($data['id']);
        $user->assign($data);
        $user->setUpdatedAt(time());
        if (!$user->save()) {
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

    /**
     * @param int $id that is user id
     *
     * @return bool|\Phalcon\Mvc\ModelInterface|Users
     */
    public function findFirstById($id)
    {
        $user = Users::query()
            ->where('id =:id:',['id' => $id])
            ->limit(1)
            ->execute();
        return $user->getFirst() ?: null;
    }
    public function getFirstByEmail($email)
    {
        return $this->findFirstByEmail($email);
    }

    /**
     * @param Users $user
     *
     * @return bool
     */
    public function isActiveMember(Users $user)
    {
        return $user->getStatus() == UserConstant::STATUS_ACTIVE;
    }
}