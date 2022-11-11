<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\Fixtures\Only;
use Tests\TestCase;

class OnlyTest extends TestCase
{
    public function testMake()
    {
        $object = Only::make([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baq' => $this->baq,
        ]);

        $this->assertSame($this->foo, $object->foo);

        $this->assertNull($object->bar);
        $this->assertNull($object->baq);
    }
}
