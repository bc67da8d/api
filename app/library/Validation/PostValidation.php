<?php
namespace Lackky\Validation;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\File;

/**
 * Class PostValidation
 *
 * @package Lackky\Validation
 */
class PostValidation extends BaseValidation
{
    public function initialize()
    {
        $this->add(
            'postText',
            new PresenceOf([
                'message' => t('The title is required'),
            ])
        );

    }
    protected function image()
    {
        $this->add(
            'image',
            new File(
                [
                    'maxSize'              => '5M',
                    'messageSize'          => ':field exceeds the max filesize (:max)',
                    'allowedTypes'         => [
                        'image/gif',
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
