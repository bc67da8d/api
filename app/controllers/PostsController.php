<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Controllers;

use Lackky\Constants\PostConstant;
use Lackky\Transformers\PostsTransformer;
use Lackky\Validation\PostValidation;

/**
 * Class PostsController
 *
 * @package Lackky\Controllers
 */
class PostsController extends ControllerBase
{

    public function createAction()
    {
        $data = $this->parserDataRequest();
        $validation = $this->validation(PostValidation::class, $data);
        if ($validation) {
            return $this->respondWithError($validation);
        }

        if (!$post = $this->modelService->post->create($data)) {
            return $this->respondWithError('Add post fail');
        }
        return $this->respondWithItem($post, new PostsTransformer());
    }
    public function updateAction($id)
    {
        $data = $this->parserDataRequest();
        if (!$this->modelService->post->isMyPost($id)) {
            return $this->respondWithError(t('You have not permission to edit post'));
        }
        $data['id'] = $id;
        if (!$post = $this->modelService->post->update($data)) {
            return $this->respondWithError(t('Update post fail'));
        }
        //Add indexer to elastic
        return $this->respondWithItem($post, new PostsTransformer());
    }
    public function deleteAction($id)
    {
        if (!$post = $this->modelService->post->isMyPost($id)) {
            return $this->respondWithError(t('You have not permission to edit post'));
        }
        $post->set('status', PostConstant::STATUS['delete']);
        $post->set('updatedAt', time());
        if (!$post->save()) {
            $this->respondWithError(t('Something wrong to delete post'));
        }
        return $this->respondWithSuccess(t('Delete post success'));
    }
    public function indexAction()
    {
        $params = $this->getParameter();
        $posts = $this->modelService->post->getPaginatorPosts($params);
        return $this->respondWithPagination($posts, new PostsTransformer());
    }
}
