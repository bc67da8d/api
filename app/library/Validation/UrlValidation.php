<?php
namespace Lackky\Validation;

use Phalcon\Validation\Validator\PresenceOf;

/**
 * Class UrlValidation
 * @package Lackky\Validation
 */
class UrlValidation extends BaseValidation
{
    public function initialize()
    {
        $this->add(
            'url',
            new PresenceOf([
                'message' => 'The url is required',
            ])
        );
    }
}
