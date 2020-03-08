<?php declare(strict_types=1);
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Traits;

use Phalcon\Cache\Backend\Libmemcached;
use Phalcon\Config;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;
use function sha1;

/**
 * Trait QueryTrait
 *
 * @package Lackky\Traits
 */
trait QueryTrait
{


    /**
     * Runs a query using the builder
     *
     * @param Config       $config
     * @param  $cache
     * @param string       $class
     * @param array        $where
     * @param string       $orderBy
     *
     * @return ResultsetInterface
     */
    protected function getRecords(
        Config $config,
        $cache,
        string $class,
        array $where = [],
        string $orderBy = ''
    ): ResultsetInterface {
        $builder = new Builder();
        $builder->addFrom($class);
        foreach ($where as $field => $value) {
            $builder->andWhere(
                sprintf('%s = :%s:', $field, $field),
                [$field => $value]
            );
        }

        if (true !== empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        return $this->getResults($config, $cache, $builder, $where);
    }

    /**
     * Runs the builder query if there is no cached data
     *
     * @param Config       $config
     * @param  $cache
     * @param Builder      $builder
     * @param array        $where
     *
     * @return ResultsetInterface
     */
    private function getResults(
        Config $config,
        $cache,
        Builder $builder,
        array $where = []
    ): ResultsetInterface {
        /**
         * Calculate the cache key
         */
        $phql     = $builder->getPhql();
        $params   = json_encode($where);
        $cacheKey = sha1(sprintf('%s-%s.cache', $phql, $params));
        if (true !== $config->path('application.debug') && true === $cache->exists($cacheKey)) {
            /** @var ResultsetInterface $data */
            $data = $cache->get($cacheKey);
        } else {
            $data = $builder->getQuery()->execute();
            $cache->save($cacheKey, $data);
        }
        return $data;
    }
    protected function getRecordsJoin(
        Config $config,
        $cache,
        string $class,
        array $where = [],
        array $joins = [],
        string $orderBy = ''
    ): ResultsetInterface {
        $builder = new Builder();
        $builder->addFrom($class);
        if (!empty($query['columns'])) {
            $builder->columns($query['columns']);
        }
        foreach ($joins as $join) {
            $type = (string) $join['type'];
            if (in_array($type, ['innerJoin', 'leftJoin', 'rightJoin', 'join'])) {
                $builder->$type(__NAMESPACE__ . '\\' . $join['model'], $join['on'], $join['alias']);
            }
        }

        foreach ($where as $field => $value) {
            $builder->andWhere(
                sprintf('%s = :%s:', $field, $field),
                [$field => $value]
            );
        }

        if (true !== empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        return $this->getResults($config, $cache, $builder, $where);
    }

    public function getPaginator($class, $params)
    {

        $builder = new Builder();
        $builder->addFrom($class, 'a');
        if (!empty($params['columns'])) {
            $builder->columns($params['columns']);
        }
        if (!empty($params['joins'])) {
            foreach ($params['joins'] as $join) {
                $type = (string) $join['type'];
                if (in_array($type, ['innerJoin', 'leftJoin', 'rightJoin', 'join'])) {
                    $builder->$type('Lackky\\Models\\' . $join['model'], $join['on'], $join['alias']);
                }
            }
        }
        if (!empty($params['where'])) {
            if (is_array($params['where'])) {
                foreach ($params['where'] as $field => $value) {
                    //This is option for ranger filter
                    if (is_array($value)) {
                        foreach ($value as $key => $rangeFilter) {
                            $builder->andWhere(
                                $rangeFilter['bind'],
                                [$key => $rangeFilter['value']]
                            );
                        }
                    } else {
                        $keys = explode('.', $field);
                        $builder->andWhere(
                            sprintf('%s = :%s:', $field, $keys[1]),
                            [$keys[1] => $value]
                        );
                    }
                }
            } else {
                $builder->where($params['where']);
            }
        }
        if (!empty($params['orWhere'])) {
            $builder->orWhere($params['orWhere']);
        }
        if (!empty($params['orderBy'])) {
            $builder->orderBy($params['orderBy']);
        }
        if (!empty($params['groupBy'])) {
            $builder->groupBy($params['groupBy']);
        }

        $paginator = new QueryBuilder(
            [
                'builder' => $builder,
                'limit'   => $params['limit'],
                'page'    => $params['page'],
            ]
        );
        return $paginator;
    }
}
