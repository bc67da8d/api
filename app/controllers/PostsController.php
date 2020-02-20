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

use Lackky\Transformers\PostTransformer;
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

        return $this->respondWithItem($post, new PostTransformer());
    }
}
