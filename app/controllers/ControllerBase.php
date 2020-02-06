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

use Lackky\Models\ModelBase;
use Lackky\Models\Services\DownloadableContentService;
use Lackky\Transformers\BaseTransformer;
use League\Fractal\Pagination\PhalconFrameworkPaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorNativeArray;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;
use Phalcon\Paginator\AdapterInterface;
use League\Fractal\Manager as FractalManager;
use Phalcon\ValidationInterface;

/**
 * Class ControllerBase
 * @property FractalManager $fractal
 * @package Lackky\Controllers
 */
class ControllerBase extends Controller
{
    /**
     * @var integer
     */
    protected $statusCode = 200;
    /**
     * @var int
     */
    protected $perPage = 10;

    /**
     * Getter for statusCode
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $item
     * @param $callback
     *
     * @return ResponseInterface
     */
    protected function respondWithItem($item, $callback)
    {
        $resource  = new Item($item, $callback);
        if (isset($_GET['include'])) {
            $this->fractal->parseIncludes($_GET['include']);
        }
        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param AdapterInterface $paginator
     * @param BaseTransformer|callable $callback
     *
     * @return ResponseInterface
     */
    protected function respondWithPagination(
        AdapterInterface $paginator,
        $callback
    ) {
        $pagination = $paginator->getPaginate();
        $resource = new Collection($pagination->items, $callback);
        $resource->setPaginator(new PhalconFrameworkPaginatorAdapter($pagination));

        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }
    /**
     * @param array|object $data
     * @return ResponseInterface
     */
    public function respondWithArray($data)
    {
        $response = new Response();
        $response->setContentType('application/json', 'UTF-8');
        if (method_exists($data, 'toArray')) {
            $data = $data->toArray();
        }
        return $response->setContent(json_encode($data, JSON_NUMERIC_CHECK));
    }

    /**
     * @param $message
     * @param string $errorCode
     *
     * @return ResponseInterface
     */
    public function respondWithError($message, $errorCode = '400')
    {
        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'httpCode' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    public function respondWithSuccess($message = 'ok')
    {
        return $this->respondWithArray([
            'success' => [
                'message' => $message,
                'code' => $this->statusCode,
                'httpCode' => $this->statusCode,
            ]
        ]);
    }

    /**
     * @param string $message
     *
     * @return ResponseInterface
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * @param $query
     *
     * @return PaginatorQueryBuilder
     */
    public function pagination($query)
    {
        $page = $this->request->getQuery('page') ?: 1;
        $perPage = $this->request->getQuery('limit') ?: $this->perPage;
        if (is_object($query)) {
            $paginator = new PaginatorModel([
                'data' => $query,
                'limit' => $perPage,
                'page' => $page
            ]);
        } elseif (isset($query['model'])) {
            $builder = ModelBase::modelQuery($query);
            $paginator = new PaginatorQueryBuilder(
                [
                    'builder' => $builder,
                    'limit' => $perPage,
                    'page' => $page
                ]
            );
        } else {
            $paginator = new PaginatorNativeArray([
                'data' => $query,
                'limit' => $perPage,
                'page' => $page
            ]);
        }
        return $paginator;
    }

    /**
     * @return array
     */
    public function getParameter()
    {
        $query = $this->request->getQuery();
        $query = array_filter($query, function ($val) {
            return !empty($val);
        });
        //define the fields required for a partial response.
        if (isset($query['fields'])) {
            $fields = explode(',', $query['fields']);
            $query['fields'] = $fields;
        }
        $query['limit'] = $query['limit'] ?? $this->perPage;
        $query['page'] = $query['page'] ?? 1;
        unset($query['_url']);
        return $query;
    }

    /**
     * @return array
     */
    public function parserDataRequest()
    {
        if ($this->request->getHeader('CONTENT_TYPE') == 'application/json') {
            $posts = $this->request->getJsonRawBody(true);
        } else {
            $posts = $this->request->getRawBody(true);
        }
        if (is_array($posts) && 0 == count($posts)) {
            $posts = $this->request->getPost();
            if ($this->request->isPut()) {
                $posts = $this->request->getPut();
            }
        }
        return $posts;
    }

    /**
     * @param $class
     * @param $input
     *
     * @return bool|string
     */
    public function validation($class, $input)
    {
        /** @var ValidationInterface  $validation */
        $validation = new $class;
        $messages = $validation->validate($input);
        foreach ($messages as $m) {
            return $m->getMessage();
        }
        return false;
    }
    /**
     * @param $id
     *
     * @return array
     */
    protected function getMetadataFile($id)
    {
        /** @var DownloadableContentService $downloadContent */
        $downloadContent = container(DownloadableContentService::class);
        return $downloadContent->getMetadata($id);
    }
    public function modelFilters(ModelBase $model)
    {
        $fields     = array_keys($model->getModelFilters());
        $data       = [];
        foreach ($fields as $field) {
            $getter = 'get' . ucfirst($field);
            $data[$field] = $model->$getter();
        }
        return $data;
    }
}
