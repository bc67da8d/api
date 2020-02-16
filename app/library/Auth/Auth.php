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

use Phalcon\Di\Injectable;
use Lackky\Models\Services;
use Lackky\Models\Services\Exceptions\EntityNotFoundException;
use Exception;

/**
 * Lackky\Auth\Auth
 *
 * Manages Authentication/Identity Management in Lackky
 *
 * @property \Phalcon\Config $config
 * @package Lackky\Auth
 */
class Auth extends Injectable
{
    /**
     * @var Services\UserService
     */
    protected $userService;

    /**
     * @var int
     */
    protected $cookieLifetime;

    /**
     * Auth constructor.
     *
     * @param null $cookieLifetime
     */
    public function __construct($cookieLifetime = null)
    {
        $this->userService = $this->getDI()->getShared(Services\UserService::class);

        if ($cookieLifetime === null) {
            $cookieLifetime = $this->config->get('application')->cookieLifetime;
        }

        $this->cookieLifetime = $cookieLifetime;
    }

    /**
     * Performs an authentication attempt.
     *
     * @param  array $credentials
     * @throws Exception
     */
    public function check(array $credentials)
    {
        try {
            $user = $this->userService->getFirstByEmail($credentials['email']);
            if (!$this->security->checkHash($credentials['password'], $user->getPassword())) {
                throw new Exception('Wrong email/password combination');
            }

            // Check if the user was flagged
            if (!$this->userService->isActiveMember($user)) {
                throw new Exception('The user is inactive');
            }
            return $user;
        } catch (EntityNotFoundException $e) {
            throw new Exception('Wrong email/password combination');
        }
    }
    /**
     * Returns the current identity
     *
     * @return array|null
     */
    public function getAuth()
    {
        if ($this->currentUser) {
            $data = (array) $this->currentUser;
            return  (array) $data['data'];
        }
        return null;
    }
    /**
     * Returns the current identity
     *
     * @return string|null
     */
    public function getName()
    {
        if (!$this->isAuthorizedVisitor()) {
            return null;
        }
        return $this->userService->getName();
    }

    /**
     * Returns the current user id
     *
     * @return int|null
     */
    public function getUserId()
    {
        if (!$this->isAuthorizedVisitor()) {
            return null;
        }

        $identity = $this->getAuth();
        return (int) $identity['id'];
    }

    /**
     * Gets current user's email if any.
     *
     * @return string|null
     */
    public function getEmail()
    {
        if (!$this->isAuthorizedVisitor()) {
            return null;
        }

        $identity = $this->getAuth();

        return $identity['email'];
    }

    /**
     * Checking user is have permission admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        if (!$this->isAuthorizedVisitor()) {
            return false;
        }
        return $this->userService->isAdmin();
    }

    /**
     * @return bool
     */
    public function isModerator()
    {
        if (!$this->isAuthorizedVisitor()) {
            return false;
        }
        return $this->userService->isModerator();
    }

    /**
     * Check whether the user is authorized.
     *
     * @return bool
     */
    public function isAuthorizedVisitor()
    {
        return $this->currentUser;
    }

    /**
     * Checking user is have permission admin
     *
     * @return boolean
     */
    public function isTrustModeration()
    {
        return $this->isAdmin() || $this->isModerator();
    }

    /**
     * Removes the user identity information from session|jwt
     */
    public function remove()
    {
        //@TODO
    }
}
