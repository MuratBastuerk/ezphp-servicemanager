<?php


namespace Mb7\EzPhp\ServiceManager\DI;


use Mb7\EzPhp\ServiceManager\DI\Exception\EzServiceException;
use Mb7\EzPhp\ServiceManager\DI\Exception\EzServiceNotFoundException;

/**
 *
 * Simple DI Container
 *
 * Class SimpleServiceManager
 * @package Mb7\EzPhp\ServiceManager\DI
 */
class SimpleServiceManager implements ServiceLocatorInterface
{
    /**
     *
     * An array holding all registered services
     *
     * @var array
     */
    private array $collection = [];

    /**
     * @inheritDoc
     */
    public function get(string $id)
    {
        try {
            if (!$this->has($id)) {
                throw new EzServiceNotFoundException("The requested service: $id was not found in ServiceManager");
            }
            return $this->collection[$id]();
        } catch (\Error $error) {
            throw new EzServiceException("Instantiation of requested service: $id failed, since its class could not be found.");
        }
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        if (array_key_exists($id, $this->collection))
            return true;
        return false;
    }

    /**
     * @inheritDoc
     */
    public function registerService(string $id, callable $callable): self
    {
        $this->collection[$id] = $callable;
        return $this;
    }
}