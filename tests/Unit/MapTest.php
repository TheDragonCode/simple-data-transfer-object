<?php

namespace Tests\Unit;

use Tests\Fixtures\Map;
use Tests\TestCase;

class MapTest extends TestCase
{
    public function testMake()
    {
        $object = Map::make([
            'wa' => [
                'sd' => $this->foo,
            ],

            'qwe.rty' => $this->bar,
            'baz'     => $this->baz,
        ]);

        $this->assertSame($this->foo, $object->foo);
        $this->assertSame($this->bar, $object->bar);
        $this->assertSame($this->baz, $object->baz);
    }

    public function testConstruct()
    {
        $object = new Map([
            'wa' => [
                'sd' => $this->foo,
            ],

            'qwe.rty' => $this->bar,
            'baz'     => $this->baz,
        ]);

        $this->assertSame($this->foo, $object->foo);

        $this->assertSame($this->foo, $object->foo);
        $this->assertSame($this->bar, $object->bar);
        $this->assertSame($this->baz, $object->baz);
    }
}
