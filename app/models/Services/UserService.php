<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace App\Models\Services;

use App\Models\Services\Exceptions\EntityNotFoundException;
use App\Models\Users;
use App\Constants\RoleConstant;

/**
 * Class UserService
 *
 * @package App\Models\Services
 */
class UserService extends Service
{
    /**
     * @var Users
     */
    protected $viewer;

    /**
     * Finds UserService by ID.
     *
     * @param  int $id The UserService ID.
     * @return Users|\Phalcon\Mvc\ModelInterface|null
     */
    public function findFirstById($id)
    {
        $user = Users::query()
            ->where('id = :id:', ['id' => $id])
            ->limit(1)
            ->execute();

        return $user->getFirst() ?: null;
    }

    /**
     * Get UserService by ID.
     *
     * @param  int $id The UserService ID.
     * @return Users
     *
     * @throws Exceptions\EntityNotFoundException
     */
    public function getFirstById($id)
    {
        if (!$user = $this->findFirstById($id)) {
            throw new EntityNotFoundException($id, 'userId');
        }
        return $user;
    }

    /**
     * Finds UserService by email address.
     *
     * @param  string $email The email address.
     * @return Users|\Phalcon\Mvc\ModelInterface|null
     */
    public function findFirstByEmail($email)
    {
        $user = Users::query()
            ->where('email = :email:', ['email' => $email])
            ->limit(1)
            ->execute();

        return $user->getFirst() ?: null;
    }

    /**
     * Finds UserService by ArtistNameUrl.
     *
     * @param  string $name The ArtistNameUrl address.
     * @return Users|\Phalcon\Mvc\ModelInterface|null
     */
    public function findFirstByArtistNameUrl($name)
    {
        $user = Users::query()
            ->where('artistNameUrl = :name:', ['name' => $name])
            ->limit(1)
            ->execute();

        return $user->getFirst() ?: null;
    }
    /**
     * Get UserService by email address.
     *
     * @param  string $email The email address.
     * @return Users
     *
     * @throws Exceptions\EntityNotFoundException
     */
    public function getFirstByEmail($email)
    {
        if (!$user = $this->findFirstByEmail($email)) {
            throw new EntityNotFoundException($email, 'email');
        }

        return $user;
    }

    /**
     * Finds UserService by username.
     *
     * @param  string $name The username.
     *
     * @return Users|\Phalcon\Mvc\ModelInterface|null
     */
    public function findFirstByUsername($name)
    {
        $user = Users::query()
            ->where('username = :name:', ['name' => $name])
            ->limit(1)
            ->execute();

        return $user->getFirst() ?: null;
    }

    /**
     * Get UserService by username.
     *
     * @param  string $name The username.
     * @return Users
     *
     * @throws Exceptions\EntityNotFoundException
     */
    public function getFirstByUsername($name)
    {
        if (!$user = $this->findFirstByUsername($name)) {
            throw new Exceptions\EntityNotFoundException($name, 'username');
        }

        return $user;
    }

    /**
     * Finds UserService by email or username.
     *
     * @param  string $name The username.
     *
     * @return Users|\Phalcon\Mvc\ModelInterface|null
     */
    public function findFirstByEmailOrUsername($name)
    {
        $user = Users::query()
            ->where('email = :email:', ['email' => $name])
            ->orWhere('username = :name:', ['name' => $name])
            ->limit(1)
            ->execute();

        return $user->getFirst() ?: null;
    }

    /**
     * Get UserService by email or username.
     *
     * @param  string $name The username.
     * @return Users
     *
     * @throws EntityNotFoundException
     */
    public function getFirstByEmailOrUsername($name)
    {
        if (!$user = $this->findFirstByEmailOrUsername($name)) {
            throw new EntityNotFoundException($name, 'email or username');
        }

        return $user;
    }

    /**
     * Finds UserService by registerHash.
     *
     * @param  string $hash The hash string generated on sign up time.
     * @return Users|\Phalcon\Mvc\ModelInterface|null
     */
    public function findFirstByRegisterHash($hash)
    {
        $user = Users::query()
            ->where('registerHash = :hash:', ['hash' => $hash])
            ->limit(1)
            ->execute();

        return  $user->getFirst() ?: null;
    }

    /**
     * Get UserService by registerHash.
     *
     * @param  string $hash The hash string generated on sign up time.
     * @return Users
     *
     * @throws Exceptions\EntityNotFoundException
     */
    public function getFirstByRegisterHash($hash)
    {
        if (!$user = $this->findFirstByRegisterHash($hash)) {
            throw new Exceptions\EntityNotFoundException($hash, 'registerHash');
        }

        return $user;
    }

    /**
     * Finds UserService by passwordForgotHash.
     *
     * @param  string $hash The hash string generated on sign up time.
     * @return Users|null
     */
    public function findFirstByPasswordForgotHash($hash)
    {
    }

    /**
     * Get UserService by passwordForgotHash.
     *
     * @param  string $hash The hash string generated on reset password up time.
     * @return Users
     *
     * @throws Exceptions\EntityNotFoundException
     */
    public function getFirstByPasswordForgotHash($hash)
    {
        if (!$user = $this->findFirstByRegisterHash($hash)) {
            throw new Exceptions\EntityNotFoundException($hash, 'passwordForgotHash');
        }

        return $user;
    }

    /**
     * Checks whether the UserService is active.
     *
     * @param  Users $user
     * @return bool
     */
    public function isActiveMember(Users $user)
    {
        return true;
    }



    /**
     * Register a new member and returns register unique URL to confirm registration.
     *
     * @param Users $entity
     *
     * @return string
     * @throws Exceptions\EntityException
     */
    public function registerNewMemberOrFail(Users $entity)
    {
    }

    /**
     * Confirm registration the new membership.
     *
     * @param Users  $entity
     * @param string $password
     *
     * @throws Exceptions\EntityException
     */
    public function confirmRegistration(Users $entity, $password)
    {
    }

    /**
     * Reset password for user.
     *
     * @param  Users $entity
     * @return array
     *
     * @throws Exceptions\EntityException
     */
    public function resetPassword(Users $entity)
    {
    }

    /**
     * Assign a new password for the UserService.
     *
     * @param  Users  $entity
     * @param  string $password
     *
     * @throws Exceptions\EntityException
     */
    public function assignNewPassword(Users $entity, $password)
    {
    }

    /**
     * Sets current viewer.
     *
     * @param Users $entity
     */
    public function setCurrentViewer(Users $entity)
    {
        $this->viewer = $entity;
    }


    /**
     * Checks whether the UserService is Admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return in_array(RoleConstant::ADMINS_SYSTEM_ROLE, $this->getRoleNamesForCurrentViewer());
    }
    /**
     * Checks whether the UserService is moderator.
     *
     * @return bool
     */
    public function isModerator()
    {
    }
    /**
     * Gets role names for current viewer.
     *
     * @return string[]
     */
    public function getRoleNamesForCurrentViewer()
    {
        $entity = $this->getCurrentViewer();
        if ($entity->getId() == 0 || $entity->countRoles() == 0) {
            return [RoleConstant::ANONYMOUS_SYSTEM_ROLE];
        }
        //@TODO remove array if the feature use multiple role for a user
        //return array_column($entity->getRoles(['columns' => ['name']])->toArray(), 'name');
        return array_column([$entity->getRoles(['columns' => ['name']])->toArray()], 'name');
    }
    /**
     * Gets current viewer.
     *
     * @return Users
     */
    public function getCurrentViewer()
    {
        if ($this->viewer) {
            return $this->viewer;
        }
        $entity = null;
        if ($this->auth->isAuthorizedVisitor()) {
            $entity = $this->findFirstById($this->auth->getUserId());
        }
        if (!$entity) {
            $entity = $this->createDefaultViewer();
        }
        $this->viewer = $entity;
        return $entity;
    }
    protected function createDefaultViewer()
    {
        $entity = new Users(['id' => 0]);
        return $entity;
    }
    public function getName()
    {
        return $this->getCurrentViewer()->getFirstname() . ' ' .$this->getCurrentViewer()->getLastname();
    }

    /**
     * @param $data
     *
     * @return Users|bool
     */
    public function create($data)
    {
        $data['password'] = container('security')->hash($data['password']);
        if (!isset($data['gender'])) {
            $data['gender'] = 'male';
        }
        $user = new Users();
        $user->setRoleId(RoleConstant::BUYER_ROLE_ID);
        $user->setCreationDate(time());
        $user->setActive(1);
        $user->assign($data);
        if (!$user->save()) {
            container('logger')->error('Add user fall '. $user->getMessages()[0]->getMessage());
            return false;
        }
        return $user;
    }
}
