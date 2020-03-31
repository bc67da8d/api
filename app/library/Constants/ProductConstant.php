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
class ProductConstant
{
    const STATUS = [
        'pending' => 1,
        'private' => 2,
        'public' => 3,
        'delete' => 4
    ];
    const STOCK_STATUS = [
        'instock' => 1,
        'outofstock' =>2,
        'onbackorder' => 3
    ];
}
