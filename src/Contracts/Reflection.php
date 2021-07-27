<?php

namespace Helldar\SimpleDataTransferObject\Contracts;

use Helldar\Support\Concerns\Resolvable;
use ReflectionClass;

trait Reflection
{
    use Resolvable;

    /**
     * @throws \ReflectionException
     *
     * @return \ReflectionClass
     */
    protected function reflection(): ReflectionClass
    {
        return self::resolveCallback(static::class, static function (string $class) {
            return new ReflectionClass($class);
        });
    }
}
