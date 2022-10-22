<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\Fixtures\Simple;
use Tests\TestCase;

class ToJsonTest extends TestCase
{
    public function testToJson()
    {
        $object = new Simple([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baz' => $this->baz,
        ]);

        $this->assertJson($object->toJson());

        $this->assertSame('{"foo":"Foo"}', $object->toJson());
    }
}
