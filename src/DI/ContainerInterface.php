<?php


namespace Mb7\EzPhp\ServiceManager\DI;


use Mb7\EzPhp\ServiceManager\DI\Exception\EzServiceException;
use Mb7\EzPhp\ServiceManager\DI\Exception\EzServiceNotFoundException;

interface ContainerInterface
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get(string $id);

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id) : bool;
}