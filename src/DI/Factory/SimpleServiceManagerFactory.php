<?php


namespace Mb7\EzPhp\ServiceManager\DI\Factory;


use Mb7\EzPhp\ServiceManager\DI\ServiceLocatorInterface;
use Mb7\EzPhp\ServiceManager\DI\SimpleServiceManager;

/**
 * Class SimpleServiceManagerFactory
 * @package Mb7\EzPhp\ServiceManager\DI\Factory
 */
class SimpleServiceManagerFactory extends ServiceManagerFactory
{
    /** @var null */
    private $serviceManager = null;

    /**
     *
     * Ensure same instance is given back
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceManager(): ServiceLocatorInterface
    {
        if ($this->serviceManager == null){
            $this->serviceManager =  new SimpleServiceManager();
        }
        return $this->serviceManager;
    }
}