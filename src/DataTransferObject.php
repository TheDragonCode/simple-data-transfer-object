<?php

namespace Helldar\SimpleDataTransferObject;

use Helldar\Contracts\DataTransferObject\DataTransferObject as Contract;
use Helldar\SimpleDataTransferObject\Contracts\Reflection;
use Helldar\Support\Concerns\Makeable;
use Helldar\Support\Facades\Helpers\Arr;
use Helldar\Support\Facades\Helpers\Str;

/**
 * @method static static make(array $items = [])
 */
abstract class DataTransferObject implements Contract
{
    use Makeable;
    use Reflection;

    protected $map = [];

    protected $disallow = ['map', 'disallow'];

    /**
     * @param  array  $items
     *
     * @throws \ReflectionException
     */
    public function __construct(array $items = [])
    {
        $this->setMap($items);
        $this->setItems($items);
    }

    /**
     * @param  array  $items
     *
     * @throws \ReflectionException
     */
    protected function setMap(array $items): void
    {
        foreach ($this->map as $from => $to) {
            $value = $this->getValueByKey($items, $from, $to);

            $this->setValue($to, $value);
        }
    }

    /**
     * @param  array  $items
     *
     * @throws \ReflectionException
     */
    protected function setItems(array $items): void
    {
        foreach ($items as $key => $value) {
            $this->setValue($key, $value);
        }
    }

    protected function getValueByKey(array $items, string $key, string $default)
    {
        return Arr::get($items, $key) ?: Arr::get($items, $default);
    }

    /**
     * @param  string  $key
     * @param  mixed  $value
     *
     * @throws \ReflectionException
     */
    protected function setValue(string $key, $value): void
    {
        if ($this->isAllow($key)) {
            $this->{$key} = $value;
        }
    }

    /**
     * @param  string  $key
     *
     * @throws \ReflectionException
     *
     * @return bool
     */
    protected function isAllow(string $key): bool
    {
        return $this->isAllowKey($key) && $this->isAllowProperty($key);
    }

    /**
     * @param  string  $key
     *
     * @throws \ReflectionException
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
