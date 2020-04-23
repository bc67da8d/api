<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Models\Services;

use Lackky\Constants\StatusConstant;
use Lackky\Models\Posts;
use Lackky\Models\Products;
use Lackky\Models\Services\Exceptions\EntityNotFoundException;

/**
 * Class ProductService
 * @package Lackky\Models\Services
 */
class ProductService extends Service
{
    /**
     * @param $id
     *
     * @return Products|null
     */
    public function findFirstById($id)
    {
        $post = Products::query()
            ->where('id = :id:', ['id' => $id])
            ->limit(1)
            ->execute();

        return $post->getFirst() ?: null;
    }

    /**
     * @param  int $id The UserService ID.
     * @return Products
     *
     * @throws Exceptions\EntityNotFoundException
     */
    public function getFirstById($id)
    {
        if (!$product = $this->findFirstById($id)) {
            throw new EntityNotFoundException($id, 'userId');
        }
        return $product;
    }

    /**
     * @param $data
     *
     * @return Products|bool
     */
    public function create($data)
    {
        $product = new Products();
        $product->setUserId($this->auth->getUserId());
        $product->setStatus(StatusConstant::STATUS_1);
        $product->setCreatedAt(time());
        $product->assign($data);
        if (!$product->save()) {
            $this->logger->error($product->getMessages()[0]->getMessage());
            return false;
        }
        return $product;
    }

    /**
     * @param $data
     *
     * @return bool|mixed
     */
    public function update($data)
    {
        if (!isset($data['id'])) {
            return false;
        }
        $product = $this->findFirstById($data['id']);
        $product->setUpdatedAt(time());
        $product->assign($data);
        if (!$product->save()) {
            $this->logger->error($product->getMessages()[0]->getMessage());
            return false;
        }
        return $product;
    }

    /**
     * @param $id
     *
     * @return bool|Posts
     */
    public function isMyPost($id)
    {
        $post = Posts::query()
            ->where('id = :id: AND userId = :userId:', [
                'id' => $id, 'userId' => $this->auth->getUserId()
            ])
            ->limit(1)
            ->execute();

        return $post->getFirst() ?: false;
    }

    public function getPaginatorPosts($params)
    {
        $params['where'] = ['a.status' => StatusConstant::STATUS_1];
        $params['orderBy'] = 'a.id DESC';
        return $this->getPaginator(Posts::class, $params);
    }
    public function getPriceCart($items)
    {
        $price = 0;
        foreach ($items as $item) {
            $product = $this->getFirstById($item['productId']);
            $price +=  $product->getPrice();
        }
        return $price;
    }
}
