<?php
namespace Lackky\Validation;

use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\File;
use Phalcon\Validation\Validator\StringLength;

/**
 * Class UserValidation
 *
 * @package Lackky\Validation
 */
class UserValidation extends BaseValidation
{
    public function initialize()
    {
        $this->add(
            'name',
            new PresenceOf([
                'message' => t('The name is required'),
            ])
        );
        $this->add(
            'password',
            new PresenceOf([
                'message' => t('The password is required'),
            ])
        );
        $this->add(
            'password',
            new StringLength([
                "max"            => 50,
                "min"            => 6,
                "messageMaximum" => "We don't like really long password",
                "messageMinimum" => "We want more than just their initials",
            ])
        );
        $this->add(
            'email',
            new PresenceOf([
                'message' => t('The email is required'),
            ])
        );
        $this->add(
            'email',
            new Email([
                'message' => t('The email not correct format'),
            ])
        );
    }
}
