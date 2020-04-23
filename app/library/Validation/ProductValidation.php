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

use Phalcon\Validation\Validator\PresenceOf;

class ProductValidation extends BaseValidation
{
    public function initialize()
    {

        $this->add(
            'name',
            new PresenceOf([
                'message' => t('The name type is required'),
            ])
        );
        $this->add(
            'price',
            new PresenceOf([
                'message' => t('The price type is required'),
            ])
        );
        $this->add(
            'image',
            new PresenceOf([
                'message' => t('The image type is required'),
            ])
        );

    }
}
