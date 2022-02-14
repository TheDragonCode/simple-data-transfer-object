<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject\Converters;

use DragonCode\Contracts\Support\Arrayable;
use DragonCode\SimpleDataTransferObject\Concerns\Reflection;
use DragonCode\Support\Concerns\Makeable;
use ReflectionException;

/**
 * @method static Objects make($object)
 */
class Objects implements Arrayable
{
    use Makeable;
    use Reflection;

    protected $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        if (method_exists($this->object, 'toArray')) {
            return $this->object->toArray();
        }

        return $this->getProperties($this->object);
    }
}
