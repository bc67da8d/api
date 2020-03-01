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

use Firebase\JWT\JWT;
use Lackky\Constants\PostConstant;
use Lackky\Constants\StatusConstant;
use Lackky\Models\Posts;
use Lackky\Models\Services\Exceptions\EntityNotFoundException;
use Lackky\Models\Users;
use Lackky\Constants\RoleConstant;

/**
 * Class PostService
 * @package Lackky\Models\Services
 */
class PostService extends Service
{


    /**
     * @param $id
     *
     * @return Posts|\Phalcon\Mvc\ModelInterface|null
     */
    public function findFirstById($id)
    {
        $post = Posts::query()
            ->where('id = :id:', ['id' => $id])
            ->limit(1)
            ->execute();

        return $post->getFirst() ?: null;
    }

    /**
     * Get UserService by ID.
     *
     * @param  int $id The UserService ID.
     * @return Users
     *
     * @throws Exceptions\EntityNotFoundException
     */
    public function getFirstById($id)
    {
        if (!$user = $this->findFirstById($id)) {
            throw new EntityNotFoundException($id, 'userId');
        }
        return $user;
    }

    /**
     * @param $data
     *
     * @return Posts|bool
     */
    public function create($data)
    {
        $post = new Posts();
        $post->setUserId($this->auth->getUserId());
        $post->setStatus(StatusConstant::STATUS_1);
        $post->setCreatedAt(time());
        $post->assign($data);
        if (!$post->save()) {
            $this->logger->error($post->getMessages()[0]->getMessage());
            return false;
        }
        return $post;
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
        $post = $this->findFirstById($data['id']);
        $post->setUpdatedAt(time());
        $post->assign($data);
        if (!$post->save()) {
            $this->logger->error($post->getMessages()[0]->getMessage());
            return false;
        }
        return $post;
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
}
