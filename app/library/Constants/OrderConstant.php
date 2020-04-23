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
class OrderConstant
{
    const STATUS = [
        'pending' => 1,
        'processing' => 2,
        'on-hold' => 3,
        'completed' => 4,
        'cancelled' => 5,
        'refunded' => 6,
        'failed' => 7,
        'trash' => 8
    ];
}
