<?php


namespace Mb7\EzPhp\ServiceManager\DI;


class SimpleServiceManager implements ServiceLocatorInterface
{

    private $collection = [];

    public function get(string $id)
    {
        return $this->collection[$id]();
    }

    public function has(string $id): bool
    {
        if (array_key_exists($id, $this->collection))
            return true;
        return false;
    }

    public function registerService(string $id, callable $callable)
    {
        $this->collection[$id] = $callable;
        return $this;
    }
}