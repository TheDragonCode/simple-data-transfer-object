<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject\Converters;

use DragonCode\Contracts\Support\Arrayable;
use DragonCode\Support\Concerns\Makeable;

/**
 * @method static Json make(string $json)
 */
class Json implements Arrayable
{
    use Makeable;

    protected $json;

    public function __construct(string $json)
    {
        $this->json = $json;
    }

    public function toArray(): array
    {
        return json_decode($this->json, true);
    }
}
