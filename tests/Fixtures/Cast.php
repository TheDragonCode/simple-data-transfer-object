<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use DragonCode\SimpleDataTransferObject\DataTransferObject;
use DragonCode\Support\Facades\Helpers\Str;

class Cast extends DataTransferObject
{
    public $foo;

    public $bar;

    public $baz;

    public $baq;

    protected $map = [
        'wa.sd'   => 'foo',
        'qwe.rty' => 'bar',
        'int'     => 'baq',
    ];

    protected function castFoo(string $value)
    {
        return Str::upper($value);
    }

    protected function castBar(string $value)
    {
        return Str::lower($value);
    }
}
