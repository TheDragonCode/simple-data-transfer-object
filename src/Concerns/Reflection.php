<?php

namespace DragonCode\SimpleDataTransferObject\Concerns;

use DragonCode\Support\Concerns\Resolvable;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

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

    /**
     * @param $object
     *
     * @throws \ReflectionException
     *
     * @return ReflectionProperty[]
     */
    protected function reflectProperties($object): array
    {
        $reflect = new ReflectionClass($object);

        return $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
    }

    /**
     * @param $object
     *
     * @throws \ReflectionException
     *
     * @return array
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
