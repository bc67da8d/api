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
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field role_id
     *
     * @param integer $roleId
     * @return $this
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field register_hash
     *
     * @param string $registerHash
     * @return $this
     */
    public function setRegisterHash($registerHash)
    {
        $this->registerHash = $registerHash;

        return $this;
    }

    /**
     * Method to set the value of field passwordForgotHash
     *
     * @param string $passwdForgotHash
     * @return $this
     */
    public function setPasswordForgotHash($passwordForgotHash)
    {
        $this->passwdForgotHash = $passwordForgotHash;

        return $this;
    }

    /**
     * Method to set the value of field gender
     *
     * @param string $gender
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Method to set the value of field avatar
     *
     * @param integer $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Method to set the value of field birthday
     *
     * @param integer $birthday
     * @return $this
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param integer $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Method to set the value of field updated_at
     *
     * @param integer $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

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
     * @return integer
     */
    public function getAvatar()
    {
        return $this->avatar;
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
            'status' => Filter::FILTER_STRING,
            'createdAt' => Filter::FILTER_INT,
            'updatedAt' => Filter::FILTER_INT
        ];
    }
}
