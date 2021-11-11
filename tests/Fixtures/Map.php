<?php

namespace Tests\Fixtures;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

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
