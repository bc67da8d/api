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

use Lackky\Transformers\CartsTransformer;
use Lackky\Validation\CartValidation;

/**
 * Class CartsController
 * @package Lackky\Controllers
 */
class CartsController extends ControllerBase
{

    public function createAction()
    {
        $data = $this->parserDataRequest();
        $validation = $this->validation(CartValidation::class, $data);
        if ($validation) {
            return $this->respondWithError($validation);
        }

        if (!$cart = $this->modelService->cart->create($data)) {
            return $this->respondWithError('Add product fail');
        }
        return $this->respondWithItem($cart, new CartsTransformer());
    }
    public function updateAction($id)
    {
        $data = $this->parserDataRequest();
        if (!$this->modelService->cart->isOwner($id)) {
            return $this->respondWithError(t('You have not permission to edit post'));
        }
        $data['id'] = $id;
        if (!$cart = $this->modelService->cart->update($data)) {
            return $this->respondWithError(t('Update post fail'));
        }
        //Add indexer to elastic
        return $this->respondWithItem($cart, new CartsTransformer());
    }
    public function deleteAction($id)
    {
        if (!$cart = $this->modelService->cart->isOwner($id)) {
            return $this->respondWithError(t('You have not permission to delete item cart'));
        }
        if (!$cart->delete()) {
            $this->respondWithError(t('Something wrong to delete item cart'));
        }
        return $this->respondWithSuccess(t('Delete item cart success'));
    }
    public function indexAction()
    {
        $params = $this->getParameter();
        $cart = $this->modelService->cart->paginator($params);
        return $this->respondWithPagination($cart, new CartsTransformer());
    }
}
