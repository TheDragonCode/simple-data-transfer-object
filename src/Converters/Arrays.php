<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject\Converters;

use DragonCode\Contracts\Support\Arrayable;
use DragonCode\Support\Concerns\Makeable;

/**
 * @method static Arrays make(array $array)
 */
class Arrays implements Arrayable
{
    use Makeable;

    protected $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function toArray(): array
    {
        return $this->values;
    }
}
