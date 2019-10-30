<?php


namespace Mb7\EzPhp\ServiceManager\DI;


use Mb7\EzPhp\ServiceManager\DI\Exception\EzServiceException;
use Mb7\EzPhp\ServiceManager\DI\Exception\EzServiceNotFoundException;

interface ServiceLocatorInterface extends ContainerInterface
{
    /**
     * @param string $id
     * @param callable $callable
     * @return mixed
     */
    public function registerService(string $id, callable $callable );
}