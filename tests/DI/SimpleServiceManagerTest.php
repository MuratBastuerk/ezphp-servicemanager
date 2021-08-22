<?php


namespace Mb7\EzPhp\ServiceManager\Test\DI;


use Mb7\EzPhp\ServiceManager\DI\Exception\EzServiceException;
use Mb7\EzPhp\ServiceManager\DI\Exception\EzServiceNotFoundException;
use Mb7\EzPhp\ServiceManager\DI\SimpleServiceManager;
use PHPUnit\Framework\TestCase;

/**
 * Class SimpleServiceManagerTest
 * @package Mb7\EzPhp\ServiceManager\Test\DI
 */
class SimpleServiceManagerTest extends TestCase
{
    /**
     * @var SimpleServiceManager
     */
    private SimpleServiceManager $cut;
    /**
     * @var string
     */
    private string $defaultId;
    /**
     * @var string
     */
    private string $defaultName;

    /**
     * Configure default values
     */
    protected function setUp(): void
    {
        $this->cut = new SimpleServiceManager();
        $this->defaultId = "testService1";
        $this->defaultName = "testObject1";

        $callable = $this->getValidCallable($this->defaultName);
        $this->cut->registerService($this->defaultId, $callable);
    }

    public function testCanCheckRegisteredService(): void
    {
        $this->assertTrue($this->cut->has($this->defaultId));
    }

    /**
     * @throws EzServiceNotFoundException
     * @throws EzServiceException
     */
    public function testCanGetRegisteredService(): void
    {
        $this->assertEquals($this->defaultName, $this->cut->get($this->defaultId)->name);
    }


    public function testRegistrationFailsWhenIdIsNotString(): void
    {
        $this->expectException(\TypeError::class);
        $this->cut->registerService(new \stdClass(), $this->getValidCallable("testObject"));
    }

    public function testRegistrationFailsWhenCallableIsNotGiven(): void
    {
        $this->expectException(\TypeError::class);
        $this->cut->registerService("test", "notACallable");
    }

    public function testReturnsFalseWhenRequiringNonExistentServiceId(): void
    {
        $this->assertFalse($this->cut->has("NotExistentService"));
    }

    public function testThrowsExceptionWhenGettingNotRegisteredService(): void
    {
        $this->expectException(EzServiceNotFoundException::class);
        $this->cut->get("notExistingService");
    }

    /**
     * @throws EzServiceNotFoundException
     */
    public function testThrowsExceptionWhenGettingServiceWithAClassThatCanNotBeFound(): void
    {
        $id = "test";
        $this->expectException(EzServiceException::class);
        $this->cut->registerService($id, function () {
            return new UnknownClass;
        });
        $this->cut->get($id);
    }

    /**
     * @param $name
     * @return callable
     */
    private function getValidCallable($name): callable
    {
        return function () use ($name) {
            $object = new \stdClass();
            $object->name = $name;
            return $object;
        };
    }
}