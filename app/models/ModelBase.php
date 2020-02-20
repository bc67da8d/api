<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Models;

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Model;
use Phalcon\Filter;

/**
 * Class ModelBase
 */
abstract class ModelBase extends Model
{
    /**
     * @return mixed
     */
    public static function getBuilder()
    {
        $di = FactoryDefault::getDefault();

        return $di->get('modelsManager')->createBuilder();
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public static function modelQuery($query)
    {
        $builder = self::getBuilder();

        if (!empty($query['model'])) {
            $builder->from(['a' => 'Lackky\\Models\\' . $query['model']]);
        }

        if (!empty($query['columns'])) {
            $builder->columns($query['columns']);
        }
        if (!empty($query['joins'])) {
            foreach ($query['joins'] as $join) {
                if (in_array($join['type'], ['innerJoin', 'leftJoin', 'rightJoin', 'join'])) {
                    $builder->$join['type']($join['model'], $join['on'], $join['alias']);
                }
            }
        }
        if (!empty($query['groupBy'])) {
            $builder->groupBy($query['groupBy']);
        }
        if (!empty($query['orderBy'])) {
            $builder->orderBy($query['orderBy']);
        }
        if (!empty($query['where'])) {
            $builder->where($query['where']);
        }
        return $builder;
    }
    public function initialize()
    {
        $this->setup(
            [
                'phqlLiterals'       => true,
                'notNullValidations' => false,
            ]
        );
    }
    /**
     * Gets a field from this model
     *
     * @param string $field The name of the field
     *
     * @return mixed
     * @throws ModelException
     */
    public function get($field)
    {
        return $this->getSetFields('get', $field);
    }
    /**
     * Returns an array of the fields/filters for this model
     *
     * @return array<string,string>
     */
    abstract public function getModelFilters(): array;
    /**
     * Returns model messages
     *
     * @param Logger|null $logger
     *
     * @return  string
     */
    public function getModelMessages($logger = null): string
    {
        //@TODO
    }
    /**
     * Sets a field in the model sanitized
     *
     * @param string $field The name of the field
     * @param mixed  $value The value of the field
     *
     * @return ModelBase
     * @throws ModelException
     */
    public function set($field, $value): ModelBase
    {
        $this->getSetFields('set', $field, $value);
        return $this;
    }
    /**
     * Gets or sets a field and sanitizes it if necessary
     *
     * @param string $type
     * @param string $field
     * @param mixed  $value
     *
     * @return mixed
     * @throws ModelException
     */
    private function getSetFields(string $type, string $field, $value = '')
    {
        $return      = null;
        $modelFields = $this->getModelFilters();
        $filter      = $modelFields[$field] ?? false;
        if (false === $filter) {
            throw new ModelException(
                sprintf(
                    'Field [%s] not found in this model',
                    $field
                )
            );
        }
        if ('get' === $type) {
            $return = $this->sanitize($this->$field, $filter);
        } else {
            $this->$field = $this->sanitize($value, $filter);
        }
        return $return;
    }
    /**
     * Uses the Phalcon Filter to sanitize the variable passed
     *
     * @param mixed        $value  The value to sanitize
     * @param string|array $filter The filter to apply
     *
     * @return mixed
     */
    private function sanitize($value, $filter)
    {
        /** @var Filter $filterService */
        $filterService = $this->getDI()->get('filter');
        return $filterService->sanitize($value, $filter);
    }
    /**
     * Reset a model instance data
     */
    public function reset()
    {
        // TODO: Implement reset() method.
    }
}
