<?php


namespace Mb7\EzPhp\ServiceManager\DI;

interface ServiceLocatorInterface extends ContainerInterface
{
    /**
     * @param string $id
     * @param callable $callable
     * @return mixed
     */
    public function registerService(string $id, callable $callable);
}