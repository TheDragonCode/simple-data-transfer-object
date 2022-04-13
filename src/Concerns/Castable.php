<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject\Concerns;

use DragonCode\Support\Facades\Helpers\Str;

/** @mixin \DragonCode\SimpleDataTransferObject\DataTransferObject */
trait Castable
{
    protected function cast($value, string $key)
    {
        $method = $this->getCastMethod($key);

        if (method_exists($this, $method)) {
            return call_user_func([$this, $method], $value);
        }

        return $value;
    }

    protected function getCastMethod(string $key, string $prefix = 'cast'): string
    {
        return (string) Str::of($key)
            ->trim()
            ->start($prefix . '_')
            ->camel();
    }
}
