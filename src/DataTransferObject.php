<?php

namespace DragonCode\SimpleDataTransferObject;

use DragonCode\Contracts\DataTransferObject\DataTransferObject as Contract;
use DragonCode\SimpleDataTransferObject\Concerns\Castable;
use DragonCode\SimpleDataTransferObject\Concerns\From;
use DragonCode\SimpleDataTransferObject\Concerns\Reflection;
use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Arr;
use DragonCode\Support\Facades\Helpers\Str;
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

    protected $map = [];

    protected $disallow = ['map', 'disallow'];

    /**
     * @param array $items
     *
     * @throws ReflectionException
     */
    public function __construct(array $items = [])
    {
        $this->setMap($items);
        $this->setItems($items);
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

    /**
     * @param array $items
     *
     * @throws ReflectionException
     */
    protected function setMap(array $items): void
    {
        foreach ($this->map as $from => $to) {
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
            $this->setValue($key, $value);
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
            $this->{$key} = $this->cast($value, $key);
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
        return ! in_array(Str::lower($key), $this->disallow, true);
    }
}
