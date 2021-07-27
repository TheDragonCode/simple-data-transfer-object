<?php

namespace Tests\Fixtures;

use Helldar\SimpleDataTransferObject\DataTransferObject;

class Map extends DataTransferObject
{
    public $foo;

    public $bar;

    public $baz;

    protected $map = [
        'wa.sd'   => 'foo',
        'qwe.rty' => 'bar',
    ];
}
