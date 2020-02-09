<?php declare(strict_types=1);

/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Lackky\Transformers;

use Lackky\Models\ModelBase;
use Exception;
use function array_intersect;
use function array_keys;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class BaseTransformer
 */
class BaseTransformer extends TransformerAbstract
{
    /** @var array */
    private $fields = [];

    /** @var string */
    private $resource = '';

    /**
     * BaseTransformer constructor.
     *
     * @param array  $fields
     * @param string $resource
     */
    public function __construct(array $fields = [], string $resource = '')
    {
        $this->fields   = $fields;
        $this->resource = $resource;
    }

    /**
     * @param ModelBase $model
     *
     * @return array
     */
    public function transform(ModelBase $model)
    {
        $modelFields     = array_keys($model->getModelFilters());
        $requestedFields = $this->fields[$this->resource] ?? $modelFields;
        $fields          = array_intersect($modelFields, $requestedFields);
        $data            = [];
        foreach ($fields as $field) {
            $getter = 'get' . ucfirst($field);
            $data[$field] = $model->$getter();
        }

        return $data;
    }

    /**
     * @param string $method
     * @param ModelBase $model
     * @param string $transformer
     * @param string $resource
     *
     * @return Collection|Item
     * @throws \Exception
     */
    protected function getRelatedData(string $method, ModelBase $model, string $transformer, string $resource)
    {
        /** @var ModelBase $data */
        $data = $model->getRelated($resource);
        if (!$data) {
            throw new Exception(
                'Something wrong when get related data',
                401
            );
        }
        return $this->$method($data, new $transformer($this->fields, $resource), 'include');
    }
}
