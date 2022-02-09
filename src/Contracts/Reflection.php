<?php

namespace DragonCode\SimpleDataTransferObject\Contracts;

use DragonCode\Support\Concerns\Resolvable;
use ReflectionClass;
use ReflectionException;

trait Reflection
{
    use Resolvable;

    /**
     * @throws ReflectionException
     *
     * @return ReflectionClass
     */
    protected function reflection(): ReflectionClass
    {
        return self::resolveCallback(static::class, static function (string $class) {
            return new ReflectionClass($class);
        });
    }
}
