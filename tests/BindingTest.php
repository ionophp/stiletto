<?php

use Iono\Stiletto\Map;
use Iono\Stiletto\Binding;

class BindingTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldBeString()
    {
        $binding = new Binding();
        $binding->setBinding(\stdClass::class, \stdClass::class);
        $binding->setBinding(\stdClass::class, \stdClass::class, 'std_class');
        $this->assertInstanceOf(Binding::class, $binding);
        $this->assertInstanceOf(Map::class, $binding->getBinding(\stdClass::class));
        $this->assertTrue($binding->hasBinding(\stdClass::class));
        $this->assertTrue($binding->hasBinding('std_class'));
        $this->assertFalse($binding->hasBinding('testing'));
    }
}
