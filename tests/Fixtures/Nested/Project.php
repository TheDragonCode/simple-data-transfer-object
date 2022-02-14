<?php

declare(strict_types=1);

namespace Tests\Fixtures\Nested;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class Project extends DataTransferObject
{
    public $title;

    public $domain;

    /** @var \Tests\Fixtures\Nested\Developer[] */
    public $developers;

    protected function castDevelopers(array $developers): array
    {
        return array_map(static function (array $developer) {
            return Developer::make($developer);
        }, $developers);
    }
}
