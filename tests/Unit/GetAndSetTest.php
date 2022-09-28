<?php

declare(strict_types=1);

namespace Tests\Unit;

use Error;
use Tests\Fixtures\Simple;
use Tests\TestCase;

class GetAndSetTest extends TestCase
{
    public function testGetPublic()
    {
        $object = Simple::make([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baz' => $this->baz,
        ]);

        $this->assertSame($this->foo, $object->get('foo'));
    }

    public function testGetProtected()
    {
        $object = Simple::make([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baz' => $this->baz,
        ]);

        $this->assertSame($this->bar, $object->get('bar'));
    }

    public function testGetPrivate()
    {
        $this->expectException(Error::class);
        $this->expectErrorMessage('Cannot access private property ' . Simple::class . '::$baz');

        $object = Simple::make([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baz' => $this->baz,
        ]);

        $object->get('baz');
    }

    public function testGetDisallow()
    {
        $this->expectException(Error::class);
        $this->expectErrorMessage('Cannot access private property ' . Simple::class . '::$map');

        $object = Simple::make([
            'foo' => $this->foo,
        ]);

        $object->get('map');
    }

    public function testSetPublic()
    {
        $object = Simple::make([
            'foo' => 123,
            'bar' => 456,
            'baz' => 789,
        ]);

        $object->set('foo', $this->foo);

        $this->assertSame($this->foo, $object->get('foo'));
    }

    public function testSetProtected()
    {
        $object = Simple::make([
            'foo' => 123,
            'bar' => 456,
            'baz' => 789,
        ]);

        $object->set('bar', $this->bar);

        $this->assertSame($this->bar, $object->get('bar'));
    }

    public function testSetPrivate()
    {
        $this->expectException(Error::class);
        $this->expectErrorMessage('Cannot access private property ' . Simple::class . '::$baz');

        $object = Simple::make([
            'foo' => $this->foo,
            'bar' => $this->bar,
            'baz' => $this->baz,
        ]);

        $object->set('baz', $this->baz);
    }

    public function testSetDisallow()
    {
        $this->expectException(Error::class);
        $this->expectErrorMessage('Cannot access private property ' . Simple::class . '::$map');

        $object = Simple::make();

        $object->set('map', 'foo');
    }
}
