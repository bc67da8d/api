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

use Lackky\Constants\OrderConstant;
use Lackky\Constants\StatusConstant;
use Lackky\Models\Carts;
use Lackky\Models\Orders;
use Lackky\Models\Posts;
use Lackky\Models\Products;
use Lackky\Models\Services\Exceptions\EntityNotFoundException;

/**
 * Class OrderService
 * @package Lackky\Models\Services
 */
class OrderService extends Service
{
    /**
     * @param $id
     *
     * @return Orders|null
     */
    public function findFirstById($id)
    {
        $post = Orders::query()
            ->where('id = :id:', ['id' => $id])
            ->limit(1)
            ->execute();

        return $post->getFirst() ?: null;
    }

    /**
     * @param $id
     *
     * @return Orders|null
     * @throws EntityNotFoundException
     */
    public function getFirstById($id)
    {
        if (!$item = $this->findFirstById($id)) {
            throw new EntityNotFoundException($id, 'id');
        }
        return $item;
    }

    /**
     * @param $data
     *
     * @return Orders|bool
     */
    public function create($data)
    {
        $items = $data['items'] ?? null;
        if (!$items) {
            return false;
        }
        $data['name'] = $data['name'] ?? 'Order Date ' . date('Y-m-d');
        $currency = $data['currency'] ?? 'VND';
        $object = new Orders();
        $object->assign($data);
        $object->set('userId', $this->auth->getUserId());
        $object->set('createdAt', time());
        $object->set('price', $this->modelService->product->getPriceCart($items));
        $object->set('currency', $currency);
        $object->set('items',json_encode($items));
        $object->set('status', OrderConstant::STATUS['pending']);
        if (!$object->save()) {
            $this->logger->error($object->getMessages()[0]->getMessage());
            return false;
        }
        //Update record cart
        $this->modelService->cart->updateOrderNull($object->getId());
        return $object;
    }



    /**
     * @param $data
     *
     * @return bool|Orders
     */
    public function update($data)
    {
        if (!isset($data['id'])) {
            return false;
        }
        $item = $this->findFirstById($data['id']);
        $item->set('updatedAt',time());
        $item->assign($data);
        if (!$item->save()) {
            $this->logger->error($item->getMessages()[0]->getMessage());
            return false;
        }
        return $item;
    }

    /**
     * @param $id
     *
     * @return bool|Carts
     */
    public function isOwner($id)
    {
        $item = Carts::query()
            ->where('id = :id: AND userId = :userId:', [
                'id' => $id, 'userId' => $this->auth->getUserId()
            ])
            ->limit(1)
            ->execute();

        return $item->getFirst() ?: false;
    }

    public function paginator($params)
    {
        //$params['where'] = ['a.status' => StatusConstant::STATUS_1];
        //$params['orderBy'] = 'a.id DESC';
        return $this->getPaginator(Orders::class, $params);
    }
}
