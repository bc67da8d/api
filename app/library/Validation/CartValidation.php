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

class CartValidation extends BaseValidation
{
    public function initialize()
    {

        $this->add(
            'quantity',
            new PresenceOf([
                'message' => t('The quantity type is required'),
            ])
        );
        $this->add(
            'productId',
            new PresenceOf([
                'message' => t('The product id type is required'),
            ])
        );

    }
}
