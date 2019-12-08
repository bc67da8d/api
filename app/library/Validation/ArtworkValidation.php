<?php
namespace Lackky\Validation;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\File;

/***
 * Class ArtworkValidation
 * @package Lackky\Validation
 */
class ArtworkValidation extends BaseValidation
{
    public function initialize()
    {
        $this->add(
            'artworkTypeId',
            new PresenceOf([
                'message' => 'The artwork type is required',
            ])
        );

        $this->add(
            'name',
            new PresenceOf(
                [
                    'message' => 'The name is required',
                ]
            )
        );
        $this->add(
            'price',
            new PresenceOf(
                [
                    'message' => 'The price is required',
                ]
            )
        );
        $this->add(
            'artworkCategoryId',
            new PresenceOf(
                [
                    'message' => 'The artwork category id is required',
                ]
            )
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
    protected function artworkFile()
    {
        $this->add(
            'artworkFile',
            new File([
                'message' => 'The artwork file is required'
            ])
        );
    }
}
