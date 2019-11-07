<?php


namespace Mb7\EzPhp\ServiceManager\Test\Factory;


use Mb7\EzPhp\ServiceManager\DI\Factory\SimpleServiceManagerFactory;
use Mb7\EzPhp\ServiceManager\DI\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class SimpleServiceManagerFactoryTest extends TestCase
{
    /**
     * @var SimpleServiceManagerFactory
     */
    private $cut;

    public function setUp()
    {
        $this->cut = new SimpleServiceManagerFactory();
    }

    public function testReturnsSimpleServiceManager(){
        $this->assertInstanceOf(ServiceLocatorInterface::class, $this->cut->getServiceManager());
    }

    public function testReturnsEveryTimeSameServiceManagerInstance(){
        $sm = $this->cut->getServiceManager();
        $sm2 = $this->cut->getServiceManager();

        $this->assertSame($sm, $sm2);
    }
}