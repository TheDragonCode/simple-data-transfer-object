<?php

declare(strict_types=1);

namespace Tests\Fixtures\Nested;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class Developer extends DataTransferObject
{
    public $name;

    public $email;
}
