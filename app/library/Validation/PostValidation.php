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

class PostValidation extends BaseValidation
{
    public function initialize()
    {

        $this->add(
            'title',
            new PresenceOf([
                'message' => t('The title is required'),
            ])
        );
    }
}
