<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\Fixtures\Map;
use Tests\TestCase;

class MergeTest extends TestCase
{
    public function testMerge()
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

        $object->merge([
            'wa' => [
                'sd' => 'Some 1',
            ],

            'qwe.rty' => 'Some 2',
            'baz'     => 'Some 3',
        ]);

        $this->assertSame('Some 1', $object->foo);
        $this->assertSame('Some 2', $object->bar);
        $this->assertSame('Some 3', $object->baz);
    }
}
