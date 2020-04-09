<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Lackky\Constants;

/**
 * Class StatusConstant
 *
 * @package Lackky\Constants
 */
class PostConstant
{
    const STATUS = [
        'draft' => 1,
        'pending' => 2,
        'private' => 3,
        'public'  => 4,
        'delete'  => 5
    ];
}
