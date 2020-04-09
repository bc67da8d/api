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
use Lackky\Models\Carts;
use Lackky\Models\Posts;
use Lackky\Models\Products;
use Lackky\Models\Services\Exceptions\EntityNotFoundException;

/**
 * Class CartService
 * @package Lackky\Models\Services
 */
class CartService extends Service
{
    /**
     * @param $id
     *
     * @return Carts|null
     */
    public function findFirstById($id)
    {
        $post = Carts::query()
            ->where('id = :id:', ['id' => $id])
            ->limit(1)
            ->execute();

        return $post->getFirst() ?: null;
    }

    /**
     * @param $id
     *
     * @return Carts|null
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
     * @return Carts|bool
     */
    public function create($data)
    {
        $item = new Carts();
        $item->set('userId', $this->auth->getUserId());
        $item->set('createdAt', time());
        $item->assign($data);
        if (!$item->save()) {
            $this->logger->error($item->getMessages()[0]->getMessage());
            return false;
        }
        return $item;
    }

    /**
     * @param $data
     *
     * @return bool|Carts
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
        return $this->getPaginator(Carts::class, $params);
    }
}
