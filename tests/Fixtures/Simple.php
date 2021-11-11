<?php

namespace Tests\Fixtures;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class Simple extends DataTransferObject
{
    public $foo;

    protected $bar;

    private $baz;

    public function getFoo()
    {
        return $this->foo;
    }

    public function getBar()
    {
        return $this->bar;
    }

    public function getBaz()
    {
        return $this->baz;
    }
}
