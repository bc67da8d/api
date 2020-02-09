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

use Phalcon\Validation\Validator\File;

/**
 * Class AvatarUserValidation
 *
 * @package App\Validation
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
