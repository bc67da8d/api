<?php
/**
 * This file is part of the Lackky API.
 *
 * (c) Lackky Team <hello@lackky.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */
namespace Lackky\Models\Services;

use Phalcon\Exception;

/**
 * Class ModelService
 * @property UserService $user
 *
 * @package Lackky\Models\Services
 */
class ModelService
{
    protected $services = [];

    public function get($service)
    {
        if (!in_array($service, array_keys($this->services))) {
            $className = __NAMESPACE__ . '\\' .ucfirst($service) . 'Service' ;
            return new $className;
        }
        return $this->services[$service];
    }
    public function set($service, $instance)
    {
        $this->services[$service] = $instance;
    }

    public function __get($service)
    {
        return $this->get($service);
    }

    public function __set($service, $instance)
    {
        $this->set($service, $instance);
    }
}
