<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject\Concerns;

use DragonCode\Support\Concerns\Resolvable;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

trait Reflection
{
    use Resolvable;

    protected function reflection(): ReflectionClass
    {
        return self::resolveCallback(static::class, static function (string $class) {
            return new ReflectionClass($class);
        });
    }

    /**
     * @throws ReflectionException
     *
     * @return array<ReflectionProperty>
     */
    protected function reflectProperties($object): array
    {
        $reflect = new ReflectionClass($object);

        return $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
    }

    /**
     * @throws ReflectionException
     */
    protected function getProperties($object): array
    {
        $result = [];

        foreach ($this->reflectProperties($object) as $property) {
            $name = $property->getName();

            $result[$name] = $object->{$name};
        }

        return $result;
    }
}
