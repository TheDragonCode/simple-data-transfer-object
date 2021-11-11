<?php

declare(strict_types=1);

namespace Tests\Unit;

use DragonCode\Support\Facades\Helpers\Str;
use Tests\Fixtures\Cast;
use Tests\TestCase;

class CastTest extends TestCase
{
    public function testMake()
    {
        $object = Cast::make([
            'wa' => [
                'sd' => $this->foo,
            ],

            'qwe.rty' => $this->bar,
            'baz'     => $this->baz,
        ]);

        $this->assertSame(Str::upper($this->foo), $object->foo);
        $this->assertSame(Str::lower($this->bar), $object->bar);
        $this->assertSame($this->baz, $object->baz);
    }

    public function testConstruct()
    {
        $object = new Cast([
            'wa' => [
                'sd' => $this->foo,
            ],

            'qwe.rty' => $this->bar,
            'baz'     => $this->baz,
        ]);

        $this->assertSame(Str::upper($this->foo), $object->foo);
        $this->assertSame(Str::lower($this->bar), $object->bar);
        $this->assertSame($this->baz, $object->baz);
    }

    public function testToArray()
    {
        $object = new Cast([
            'wa' => [
                'sd' => $this->foo,
            ],

            'qwe.rty' => $this->bar,
            'baz'     => $this->baz,
        ]);

        $this->assertIsArray($object->toArray());

        $this->assertSame([
            'foo' => Str::upper($this->foo),
            'bar' => Str::lower($this->bar),
            'baz' => $this->baz,
        ], $object->toArray());
    }
}
