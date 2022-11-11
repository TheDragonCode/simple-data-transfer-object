<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class Only extends DataTransferObject
{
    public $foo;

    public $bar;

    public $baq;

    protected $map = [
        'qwe' => 'foo',
        'rty' => 'bar',
    ];

    protected $only = [
        'foo',
    ];
}
