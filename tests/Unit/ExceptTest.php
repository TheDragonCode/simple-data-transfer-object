<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\Fixtures\Except;
use Tests\TestCase;

class ExceptTest extends TestCase
{
    public function testMake()
    {
        $object = Except::make([
            'bar' => $this->bar,
            'baq' => $this->baq,
            'qwe' => $this->foo,
            'rty' => $this->baq,
        ]);

        $this->assertIsArray($object->toArray());

        $this->assertSame([
            'foo' => $this->foo,
            'bar' => $this->baq,
            'baq' => $this->baq,
        ], $object->toArray());
    }
}
