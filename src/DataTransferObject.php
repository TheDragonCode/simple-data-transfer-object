<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject;

use DragonCode\Contracts\DataTransferObject\DataTransferObject as Contract;
use DragonCode\SimpleDataTransferObject\Concerns\Castable;
use DragonCode\SimpleDataTransferObject\Concerns\From;
use DragonCode\SimpleDataTransferObject\Concerns\Reflection;
use DragonCode\SimpleDataTransferObject\Concerns\To;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Arr;
use DragonCode\Support\Facades\Helpers\Str;
use Error;
use ReflectionException;

/**
 * @method static static make(array $items = [])
 */
abstract class DataTransferObject implements Contract
{
    use Castable;
    use From;
    use Makeable;
    use Reflection;
    use To;

    protected const DISALLOW = ['map', 'only', 'except'];

    protected $map = [];

    protected $only = [];

    protected $except = [];

    /**
     * @param array $items
     *
     * @throws ReflectionException
     */
    public function __construct(array $items = [])
    {
        $this->merge($items);
    }

    public function get(string $key)
    {
        if ($this->isAllow($key)) {
            return $this->{$key};
        }

        throw new Error('Cannot access private property ' . static::class . '::$' . $key);
    }

    public function set(string $key, $value): DataTransferObject
    {
        if (! $this->isAllow($key)) {
            throw new Error('Cannot access private property ' . static::class . '::$' . $key);
        }

        $this->{$key} = $value;

        return $this;
    }

    /**
     * @param array $items
     *
     * @throws \ReflectionException
     * @return \DragonCode\SimpleDataTransferObject\DataTransferObject
     */
    public function merge(array $items): DataTransferObject
    {
        $items = $this->filter($items);

        $this->setMap($items);
        $this->setItems($items);

        return $this;
    }

    /**
     * @throws ReflectionException
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->getProperties($this);
    }

    protected function filter(array $items): array
    {
        return $this->filterOnly(
            $this->filterExcept($items)
        );
    }

    protected function filterOnly(array $items): array
    {
        if ($keys = $this->only) {
            return Arr::only($items, $keys);
        }

        return $items;
    }

    protected function filterExcept(array $items): array
    {
        if ($keys = $this->except) {
            return Arr::except($items, $keys);
        }

        return $items;
    }

    /**
     * @param array $items
     *
     * @throws ReflectionException
     */
    protected function setMap(array $items): void
    {
        foreach ($this->map as $from => $to) {
            if ($this->sourceKeyDoesntExist($items, $from)) {
                continue;
            }

            $value = $this->getValueByKey($items, $from, $to);

            $this->setValue($to, $value);
        }
    }

    /**
     * @param array $items
     *
     * @throws ReflectionException
     */
    protected function setItems(array $items): void
    {
        foreach ($items as $key => $value) {
            $this->setValue((string) $key, $value);
        }
    }

    protected function getValueByKey(array $items, string $key, string $default)
    {
        if (Arr::exists($items, $key)) {
            return Arr::get($items, $key);
        }

        return Arr::get($items, $default);
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @throws ReflectionException
     */
    protected function setValue(string $key, $value): void
    {
        if ($this->isAllow($key)) {
            $this->set($key, $this->cast($value, $key));
        }
    }

    /**
     * @param string $key
     *
     * @throws ReflectionException
     *
     * @return bool
     */
    protected function isAllow(string $key): bool
    {
        return $this->isAllowKey($key) && $this->isAllowProperty($key);
    }

    /**
     * @param string $key
     *
     * @throws ReflectionException
     *
     * @return bool
     */
    protected function isAllowProperty(string $key): bool
    {
        if ($this->reflection()->hasProperty($key)) {
            $property = $this->reflection()->getProperty($key);

            return ! $property->isStatic() && ! $property->isPrivate();
        }

        return false;
    }

    protected function isAllowKey(string $key): bool
    {
        return ! in_array(Str::lower($key), self::DISALLOW, true);
    }

    protected function sourceKeyDoesntExist(array $items, string $key): bool
    {
        return ! Arr::exists($items, $key);
    }
}
