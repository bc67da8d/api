<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Transformers;
use Lackky\Constants\RelationshipsConstant;
use Lackky\Models\Posts;
use Lackky\Models\Products;
use Phalcon\Exception;

/**
 * Class ProductsTransformer
 * @package Lackky\Transformers
 */
class ProductsTransformer extends BaseTransformer
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        RelationshipsConstant::USER
    ];

    /**
     * @param Products $product
     *
     * @return array|\League\Fractal\Resource\Collection|\League\Fractal\Resource\Item
     * @throws \Exception
     */
    public function includeUser(Products $product)
    {
        try {
            return $this->getRelatedData(
                'item',
                $product,
                UsersTransformer::class,
                RelationshipsConstant::USER
            );
        } catch (Exception $e) {
            return [];
        }
    }
}
