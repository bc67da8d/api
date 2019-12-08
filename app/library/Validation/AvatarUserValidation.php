<?php
namespace Lackky\Validation;

use Phalcon\Validation\Validator\File;

/**
 * Class AvatarUserValidation
 *
 * @package Lackky\Validation
 */
class AvatarUserValidation extends BaseValidation
{
    public function initialize()
    {
        $this->add(
            'file',
            new File(
                [
                    'maxSize'              => '4M',
                    'messageSize'          => ':field exceeds the max filesize (:max)',
                    'allowedTypes'         => [
                        'image/jpg',
                        'image/png',
                        'image/bmp',
                        'image/jpeg'
                    ],
                    'messageType'          => 'Allowed file types are :types',
                ]
            )
        );
    }
}
