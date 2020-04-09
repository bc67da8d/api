<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Models;

use Lackky\Models\Services\MediaDataService;
use Phalcon\Filter;

/**
 * Users
 *
 * @date 2020-02-07, 15:24:19
 */
class Users extends ModelBase
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $roleId;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $registerHash;

    /**
     *
     * @var string
     */
    protected $passwordForgotHash;

    /**
     *
     * @var string
     */
    protected $gender;

    /**
     *
     * @var integer
     */
    protected $avatar;

    /**
     *
     * @var integer
     */
    protected $birthday;

    /**
     *
     * @var string
     */
    protected $status;

    /**
     *
     * @var integer
     */
    protected $createdAt;

    /**
     *
     * @var integer
     */
    protected $updatedAt;
    /**
     * @var string
     */
    protected $bio;

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field roleId
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field registerHash
     *
     * @return string
     */
    public function getRegisterHash()
    {
        return $this->registerHash;
    }

    /**
     * Returns the value of field getPasswordForgotHash
     *
     * @return string
     */
    public function getPasswordForgotHash()
    {
        return $this->passwordForgotHash;
    }

    /**
     * Returns the value of field gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Returns the value of field avatar
     *
     * @return []
     */
    public function getAvatar()
    {
        return $this->getMetadataFile($this->avatar);
    }

    /**
     * Returns the value of field birthday
     *
     * @return integer
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Returns the value of field status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the value of field createdAt
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Returns the value of field updatedAt
     *
     * @return integer
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("users");
    }

    /**
     * @param string|null $bio
     */
    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    /**
     * @return string
     */
    public function getBio(): ?string
    {
        return $this->bio;
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'role_id' => 'roleId',
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'register_hash' => 'registerHash',
            'password_forgot_hash' => 'passwordForgotHash',
            'gender' => 'gender',
            'avatar' => 'avatar',
            'birthday' => 'birthday',
            'bio' => 'bio',
            'status' => 'status',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt'
        ];
    }

    /**
     * Returns an array of the fields/filters for this model
     *
     * @return array<string,string>
     */
    public function getModelFilters(): array
    {
        return [
            'id' => Filter::FILTER_INT,
            'name' => Filter::FILTER_STRING,
            'email' => Filter::FILTER_STRING,
            'gender' => Filter::FILTER_STRING,
            'avatar' => Filter::FILTER_STRING,
            'birthday' => Filter::FILTER_STRING,
            'bio' => Filter::FILTER_STRING,
            'status' => Filter::FILTER_STRING,
            'createdAt' => Filter::FILTER_INT,
            'updatedAt' => Filter::FILTER_INT
        ];
    }
}
