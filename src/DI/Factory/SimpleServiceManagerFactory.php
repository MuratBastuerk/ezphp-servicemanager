<?php


namespace Mb7\EzPhp\ServiceManager\DI\Factory;


use Mb7\EzPhp\ServiceManager\DI\SimpleServiceManager;

class SimpleServiceManagerFactory extends ServiceManagerFactory
{
    function getServiceManager()
    {
        return new SimpleServiceManager();
    }
}