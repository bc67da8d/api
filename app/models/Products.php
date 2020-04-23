<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Models;
use Phalcon\Filter;
/**
 * Products
 * 
 * @autogenerated by Phalcon Developer Tools
 * @date 2020-03-29, 10:40:47
 */
class Products extends ModelBase
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $slug;

    /**
     *
     * @var string
     */
    protected $type;

    /**
     *
     * @var string
     */
    protected $featured;

    /**
     *
     * @var string
     */
    protected $price;

    /**
     *
     * @var string
     */
    protected $salePrice;

    /**
     *
     * @var string
     */
    protected $sku;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var string
     */
    protected $shortDescription;

    /**
     *
     * @var string
     */
    protected $onSale;

    /**
     *
     * @var string
     */
    protected $weight;

    /**
     *
     * @var string
     */
    protected $categories;

    /**
     *
     * @var string
     */
    protected $tags;

    /**
     *
     * @var string
     */
    protected $images;

    /**
     *
     * @var string
     */
    protected $stockStatus;

    /**
     *
     * @var string
     */
    protected $status;

    /**
     * @var integer
     */
    protected $userId;
    /**
     *
     * @var integer
     */
    protected $createdAt;

    /**
     *
     * @var integer
     */
    protected $updatedAt;

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Returns the value of field type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the value of field featured
     *
     * @return string
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Returns the value of field price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field salePrice
     *
     * @return string
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * Returns the value of field sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Returns the value of field onSale
     *
     * @return string
     */
    public function getOnSale()
    {
        return $this->onSale;
    }

    /**
     * Returns the value of field weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Returns the value of field categories
     *
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Returns the value of field tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Returns the value of field images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Returns the value of field stockStatus
     *
     * @return string
     */
    public function getStockStatus()
    {
        return $this->stockStatus;
    }

    /**
     * Returns the value of field status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the value of field createdAt
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Returns the value of field updatedAt
     *
     * @return integer
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("products");
        $this->belongsTo(
            'userId',
            Users::class,
            'id',
            ['alias' => 'user']
        );
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'slug' => 'slug',
            'type' => 'type',
            'featured' => 'featured',
            'price' => 'price',
            'sale_price' => 'salePrice',
            'sku' => 'sku',
            'description' => 'description',
            'short_description' => 'shortDescription',
            'on_sale' => 'onSale',
            'weight' => 'weight',
            'categories' => 'categories',
            'tags' => 'tags',
            'images' => 'images',
            'stock_status' => 'stockStatus',
            'status' => 'status',
            'user_id' => 'userId',
            'created_at' => 'createdAt',
            'updated_at' => 'updatedAt'
        ];
    }

    /**
     * @inheritDoc
     */
    public function getModelFilters(): array
    {
        // TODO: Implement getModelFilters() method.
    }
}
