<?php

declare(strict_types=1);

namespace Lackky\Traits;

use Phalcon\Cache\Backend\Libmemcached;
use Phalcon\Config;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\ResultsetInterface;
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
}
