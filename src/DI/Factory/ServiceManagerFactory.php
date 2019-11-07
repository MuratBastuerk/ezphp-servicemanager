<?php


namespace Mb7\EzPhp\ServiceManager\DI\Factory;


use Mb7\EzPhp\ServiceManager\DI\ServiceLocatorInterface;

abstract class ServiceManagerFactory
{
    abstract function getServiceManager() : ServiceLocatorInterface;
}