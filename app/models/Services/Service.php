<?php
namespace Lackky\Models\Services;

use Lackky\Traits\QueryTrait;
use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Di\Injectable;

/**
 * \Lackky\Models\Services\Service
 *
 * @property \Phalcon\Config $config
 * @property \Phalcon\Security\Random $random
 * @property \Phalcon\Logger\AdapterInterface $logger
 *
 * @package Lackky\Models\Services
 */
abstract class Service extends Injectable
{
    use QueryTrait;
    /**
     * Service constructor.
     *
     * @param DiInterface|null $di
     */
    public function __construct(DiInterface $di = null)
    {
        $this->setDI($di ?: Di::getDefault());
    }
    /**
     * @return mixed
     */
    public function getBuilder()
    {
        $di = Di::getDefault();
        return $di->get('modelsManager')->createBuilder();
    }
}
