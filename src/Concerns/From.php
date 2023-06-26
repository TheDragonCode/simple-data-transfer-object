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
     * @throws ReflectionException
     */
    public static function fromArray(array $array): Contract
    {
        return new static($array);
    }

    /**
     * @throws ReflectionException
     */
    public static function fromObject($object): Contract
    {
        $values = Objects::make($object)->toArray();

        return self::fromArray($values);
    }

    /**
     * @throws ReflectionException
     */
    public static function fromRequest(Request $request): Contract
    {
        $values = Requests::make($request)->toArray();

        return self::fromArray($values);
    }

    /**
     * @throws ReflectionException
     */
    public static function fromJson(string $json): Contract
    {
        $values = Json::make($json)->toArray();

        return self::fromArray($values);
    }
}
