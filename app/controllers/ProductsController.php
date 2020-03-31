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

use Lackky\Constants\ProductConstant;
use Lackky\Transformers\ProductsTransformer;
use Lackky\Validation\ProductValidation;

/**
 * Class ProductsController
 * @package Lackky\Controllers
 */
class ProductsController extends ControllerBase
{

    public function createAction()
    {
        $data = $this->parserDataRequest();
        $validation = $this->validation(ProductValidation::class, $data);
        if ($validation) {
            return $this->respondWithError($validation);
        }

        if (!$product = $this->modelService->product->create($data)) {
            return $this->respondWithError('Add product fail');
        }
        return $this->respondWithItem($product, new ProductsTransformer());
    }
    public function updateAction($id)
    {
        $data = $this->parserDataRequest();
        if (!$this->modelService->post->isMyPost($id)) {
            return $this->respondWithError(t('You have not permission to edit post'));
        }
        $data['id'] = $id;
        if (!$product = $this->modelService->post->update($data)) {
            return $this->respondWithError(t('Update post fail'));
        }
        //Add indexer to elastic
        return $this->respondWithItem($product, new ProductsTransformer());
    }
    public function deleteAction($id)
    {
        if (!$post = $this->modelService->post->isMyPost($id)) {
            return $this->respondWithError(t('You have not permission to edit post'));
        }
        $post->setStatus(ProductConstant::STATUS['delete']);
        $post->setUpdatedAt(time());
        if (!$post->save()) {
            $this->respondWithError(t('Something wrong to delete post'));
        }
        return $this->respondWithSuccess(t('Delete post success'));
    }
    public function indexAction()
    {
        $params = $this->getParameter();
        $product = $this->modelService->post->getPaginatorPosts($params);
        return $this->respondWithPagination($product, new ProductsTransformer());
    }
}
