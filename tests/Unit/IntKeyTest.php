<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\Fixtures\Map;
use Tests\TestCase;

class IntKeyTest extends TestCase
{
    public function testMake()
    {
        $object = Map::make([
            $this->foo,
            $this->bar,
            $this->baz,
        ]);

        $this->assertNull($object->foo);
        $this->assertNull($object->bar);
        $this->assertNull($object->baz);
    }
}
