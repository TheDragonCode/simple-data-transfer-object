<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject\Concerns;

use DragonCode\Contracts\DataTransferObject\DataTransferObject as Contract;
use DragonCode\SimpleDataTransferObject\Converters\Json;
use DragonCode\SimpleDataTransferObject\Converters\Objects;
use DragonCode\SimpleDataTransferObject\Converters\Requests;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;

/** @mixin \DragonCode\SimpleDataTransferObject\DataTransferObject */
trait From
{
    /**
     * @param array $array
     *
     * @throws ReflectionException
     *
     * @return \DragonCode\Contracts\DataTransferObject\DataTransferObject
     */
    public static function fromArray(array $array): Contract
    {
        return new static($array);
    }

    /**
     * @param $object
     *
     * @throws ReflectionException
     *
     * @return \DragonCode\Contracts\DataTransferObject\DataTransferObject
     */
    public static function fromObject($object): Contract
    {
        $values = Objects::make($object)->toArray();

        return self::fromArray($values);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @throws ReflectionException
     *
     * @return \DragonCode\Contracts\DataTransferObject\DataTransferObject
     */
    public static function fromRequest(Request $request): Contract
    {
        $values = Requests::make($request)->toArray();

        return self::fromArray($values);
    }

    /**
     * @param string $json
     *
     * @throws ReflectionException
     *
     * @return \DragonCode\Contracts\DataTransferObject\DataTransferObject
     */
    public static function fromJson(string $json): Contract
    {
        $values = Json::make($json)->toArray();

        return self::fromArray($values);
    }
}
