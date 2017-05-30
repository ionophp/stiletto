<?php

use Iono\Stiletto\Map;
use Iono\Stiletto\Binding;
use Iono\Stiletto\Container;

class ContainerTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldBeStdClassInstance()
    {
        $binding = new Binding();
        $binding->setBinding(\stdClass::class, \stdClass::class);
        $container = new Container($binding);
        $this->assertTrue($container->has(\stdClass::class));
        $this->assertInstanceOf(\stdClass::class, $container->get(\stdClass::class));
    }

    public function testShouldReturnResolveParameter()
    {
        $binding = new Binding();
        $binding->setBinding(\StubParameterHasClass::class, \StubParameterHasClass::class);
        $binding->setParameters(\StubParameterHasClass::class, 'name', 1);
        $binding->setBinding(\stdClass::class, \stdClass::class);
        $binding->setBinding(\StubParameterHasClass::class, \StubParameterHasClass::class, 'testing');
        $binding->setParameters('testing', 'name', new \Iono\Stiletto\Instance(\stdClass::class));
        $container = new Container($binding);
        $resolved = $container->get(StubParameterHasClass::class);
        $this->assertInstanceOf(StubParameterHasClass::class, $resolved);
        $this->assertSame(1, $resolved->name());
        $resolved = $container->get('testing');
        $this->assertInstanceOf(StubParameterHasClass::class, $resolved);
        $this->assertInstanceOf(\stdClass::class, $resolved->name());
    }
}

class StubParameterHasClass
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function name()
    {
        return $this->name;
    }
}
