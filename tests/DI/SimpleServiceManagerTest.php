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
    private $cut;
    /**
     * @var string
     */
    private $defaultId;
    /**
     * @var string
     */
    private $defaultName;

    /**
     * Configure default values
     */
    public function setUp()
    {
        $this->cut = new SimpleServiceManager();
        $this->defaultId = "testService1";
        $this->defaultName = "testObject1";

        $callable = $this->getValidCallable($this->defaultName);
        $this->cut->registerService($this->defaultId, $callable);
    }

    public function testCanCheckRegisteredService()
    {
        $this->assertTrue($this->cut->has($this->defaultId));
    }

    public function testCanGetRegisteredService(){
        $this->assertEquals($this->defaultName, $this->cut->get($this->defaultId)->name);
    }

    public function testRegistrationFailsWhenIdIsNotString(){
        $this->expectException(\TypeError::class);
        $this->cut->registerService(new \stdClass(), $this->getValidCallable("testObject"));
    }

    public function testRegistrationFailsWhenCallableIsNotGiven(){
        $this->expectException(\TypeError::class);
        $this->cut->registerService("test", "notACallable");
    }

    public function testReturnsFalseWhenRequiringNonExistentServiceId()
    {
        $this->assertFalse($this->cut->has("NotExistentService"));
    }

    public function testThrowsExceptionWhenGettingNotRegisteredService()
    {
        $this->expectException(EzServiceNotFoundException::class);
        $this->cut->get("notExistingService");
    }

    public function testThrowsExceptionWhenGettingServiceWithAClassThatCanNotBeFound()
    {
        $id = "test";
        $this->expectException(EzServiceException::class);
        $this->cut->registerService($id, function (){return new UnknownClass;});
        $this->cut->get($id);
    }

    private function getValidCallable($name) : callable {
        return function () use ($name) {
            $object = new \stdClass();
            $object->name = $name;
            return $object;
        };
    }
}