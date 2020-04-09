<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Validation;

use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class UserValidation extends BaseValidation
{
    public function initialize()
    {

        $this->add(
            'email',
            new PresenceOf([
                'message' => t('The email type is required'),
            ])
        );
        $this->add(
            'name',
            new PresenceOf([
                'message' => t('The name type is required'),
            ])
        );
        $this->add(
            'password',
            new PresenceOf([
                'message' => t('The password type is required'),
            ])
        );

        $this->add(
            'email',
            new StringLength([
                'max'            => 20,
                'min'            => 5,
                'messageMaximum' => t("We don't like really long email"),
                'messageMinimum' => t("We don't like really short email"),
            ])
        );
        $this->add(
            'password',
            new StringLength([
                'max'            => 20,
                'min'            => 5,
                'messageMaximum' => t("We don't like really long password"),
                'messageMinimum' => t("We don't like really short password"),
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
