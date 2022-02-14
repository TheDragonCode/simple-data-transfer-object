<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use DragonCode\Contracts\Support\Arrayable;

class CustomObjectArrayable extends CustomObject implements Arrayable
{
    public function toArray(): array
    {
        return [
            'foo' => $this->foo . '_2',
            'bar' => $this->bar . '_2',
        ];
    }
}
