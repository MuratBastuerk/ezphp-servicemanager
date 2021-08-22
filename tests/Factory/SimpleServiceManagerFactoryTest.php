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
    private SimpleServiceManagerFactory $cut;


    protected function setUp(): void
    {
        $this->cut = new SimpleServiceManagerFactory();
    }

    public function testReturnsSimpleServiceManager(): void
    {
        $this->assertInstanceOf(ServiceLocatorInterface::class, $this->cut->getServiceManager());
    }

    public function testReturnsEveryTimeSameServiceManagerInstance(): void
    {
        $sm = $this->cut->getServiceManager();
        $sm2 = $this->cut->getServiceManager();

        $this->assertSame($sm, $sm2);
    }
}