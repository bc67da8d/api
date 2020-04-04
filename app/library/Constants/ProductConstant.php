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
        'draft' => 1,
        'pending' => 2,
        'private' => 3,
        'public' => 4,
        'delete' => 5
    ];
    const STOCK_STATUS = [
        'instock' => 1,
        'outofstock' =>2,
        'onbackorder' => 3
    ];
    const TYPE = [
        'simple' => 1,
        'grouped' => 2,
        'external' => 3,
        'variable' => 4
    ];
    const FEATURE = [
        'disable' => 0,
        'enable' => 1
    ];
}
