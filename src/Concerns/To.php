<?php

declare(strict_types=1);

namespace DragonCode\SimpleDataTransferObject\Concerns;

trait To
{
    public function toJson($flags = JSON_UNESCAPED_UNICODE): string
    {
        return json_encode($this->toArray(), $flags);
    }
}
