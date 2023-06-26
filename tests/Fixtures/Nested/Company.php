<?php

declare(strict_types=1);

namespace Tests\Fixtures\Nested;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class Company extends DataTransferObject
{
    public $title;

    /** @var array<\Tests\Fixtures\Nested\Project> */
    public $projects;

    protected function castProjects(array $projects): array
    {
        return array_map(static function (array $project) {
            return Project::make($project);
        }, $projects);
    }
}
