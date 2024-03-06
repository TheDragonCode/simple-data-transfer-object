<?php

declare(strict_types=1);

namespace Tests\Unit;

use Symfony\Component\HttpFoundation\Request;
use Tests\Fixtures\CustomObject;
use Tests\Fixtures\CustomObjectArrayable;
use Tests\Fixtures\Simple;
use Tests\TestCase;

class FromTest extends TestCase
{
    public function testArray()
    {
        $object = Simple::fromArray([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baz' => $this->baz,
        ]);

        $this->assertSame($this->foo, $object->foo);

        $this->assertSame($this->foo, $object->getFoo());
        $this->assertSame($this->bar, $object->getBar());

        $this->assertNull($object->getBaz());
    }

    public function testJson()
    {
        $json = json_encode([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baz' => $this->baz,
        ]);

        $object = Simple::fromJson($json);

        $this->assertSame($this->foo, $object->foo);

        $this->assertSame($this->foo, $object->getFoo());
        $this->assertSame($this->bar, $object->getBar());

        $this->assertNull($object->getBaz());
    }

    public function testObject()
    {
        $custom = new CustomObject();

        $object = Simple::fromObject($custom);

        $this->assertSame($this->foo, $object->foo);

        $this->assertSame($this->foo, $object->getFoo());
        $this->assertSame($this->bar, $object->getBar());

        $this->assertNull($object->getBaz());
    }

    public function testObjectArrayable()
    {
        $custom = new CustomObjectArrayable();

        $object = Simple::fromObject($custom);

        $this->assertSame($this->foo . '_2', $object->foo);

        $this->assertSame($this->foo . '_2', $object->getFoo());
        $this->assertSame($this->bar . '_2', $object->getBar());

        $this->assertNull($object->getBaz());
    }

    public function testRequest()
    {
        if (! method_exists(Request::class, 'toArray')) {
            $this->assertTrue(true);

            return;
        }

        $content = json_encode([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baz' => $this->baz,
        ]);

        $request = new Request([], [], [], [], [], [], $content);

        $object = Simple::fromRequest($request);

        $this->assertSame($this->foo, $object->foo);

        $this->assertSame($this->foo, $object->getFoo());
        $this->assertSame($this->bar, $object->getBar());

        $this->assertNull($object->getBaz());
    }
}
