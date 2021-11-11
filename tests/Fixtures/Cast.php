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

    protected $map = [
        'wa.sd'   => 'foo',
        'qwe.rty' => 'bar',
    ];

    protected function castFoo($value)
    {
        return Str::upper($value);
    }

    protected function castBar($value)
    {
        return Str::lower($value);
    }
}
