<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\Fixtures\Nested\Company;
use Tests\TestCase;

class NestedTest extends TestCase
{
    protected $values = [
        'title' => 'First Company',

        'projects' => [
            [
                'title'  => 'Project 1',
                'domain' => 'https://example.com',

                'developers' => [
                    [
                        'name'  => 'Andrey Helldar',
                        'email' => 'helldar@ai-rus.com',
                    ],
                    [
                        'name'  => 'John Doe',
                        'email' => 'doe@example.com',
                    ],
                    [
                        'name'  => 'Luke Skywalker',
                        'email' => 'son@example.com',
                    ],
                ],
            ],
        ],
    ];

    public function testCasting()
    {
        $object = Company::make($this->values);

        $this->assertSame('First Company', $object->title);

        $this->assertIsArray($object->projects);

        $this->assertSame('Project 1', $object->projects[0]->title);
        $this->assertSame('https://example.com', $object->projects[0]->domain);

        $this->assertIsArray($object->projects[0]->developers);

        $this->assertSame('Andrey Helldar', $object->projects[0]->developers[0]->name);
        $this->assertSame('helldar@ai-rus.com', $object->projects[0]->developers[0]->email);

        $this->assertSame('John Doe', $object->projects[0]->developers[1]->name);
        $this->assertSame('doe@example.com', $object->projects[0]->developers[1]->email);

        $this->assertSame('Luke Skywalker', $object->projects[0]->developers[2]->name);
        $this->assertSame('son@example.com', $object->projects[0]->developers[2]->email);
    }
}
