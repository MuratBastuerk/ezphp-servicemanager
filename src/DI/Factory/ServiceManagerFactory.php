<?php


namespace Mb7\EzPhp\ServiceManager\DI\Factory;


use Mb7\EzPhp\ServiceManager\DI\ServiceLocatorInterface;


abstract class ServiceManagerFactory
{
    /**
     * @return ServiceLocatorInterface
     */
    abstract function getServiceManager() : ServiceLocatorInterface;
}