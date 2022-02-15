# Simple Data Transfer Object

<img src="https://preview.dragon-code.pro/TheDragonCode/simple-dto.svg?brand=php" alt="Simple DTO"/>

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Installation

To get the latest version of `Simple Data Transfer Object`, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require dragon-code/simple-dto
```

Or manually update `require` block of `composer.json` and run `composer update`.

```json
{
    "require": {
        "dragon-code/simple-dto": "^2.0"
    }
}
```

### Upgrade from `andrey-helldar/simple-data-transfer-object`

1. Replace `"andrey-helldar/simple-data-transfer-object": "^1.0"` with `"dragon-code/simple-dto": "^2.0"` in the `composer.json` file;
2. Replace `Helldar\SimpleDataTransferObject` namespace prefix with `DragonCode\SimpleDataTransferObject` in your application;
3. Call the `composer update` console command.

### Upgrade from `dragon-code/simple-data-transfer-object`

1. Replace `dragon-code/simple-data-transfer-object` with `dragon-code/simple-dto` in the `composer.json` file;
2. Call the `composer update` console command.

## Using

### Basic

```php
namespace App\DTO;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class YourInstance extends DataTransferObject
{
    public $foo;

    public $bar;

    public $baz;

    public $qwerty;
}

$instance = YourInstance::make([
    'foo' => 'Foo',
    'bar' => 'Bar'
    'baz' => 'Baz'
]);


return $instance->foo;
// Foo

return $instance->bar;
// Bar

return $instance->baz;
// Baz

return $instance->qwerty;
// null
```

### Mappings

```php
namespace App\DTO;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class YourInstance extends DataTransferObject
{
    public $foo;

    public $bar;

    public $baz;

    public $qwerty;

    protected $map = [
        'data.foo' => 'foo',
        'data.bar' => 'bar',
    ];
}

$instance = YourInstance::make([
    'data' => [
        'foo' => 'Foo',
        'bar' => 'Bar'
    ],
    'baz' => 'Baz'
]);


return $instance->foo;
// Foo

return $instance->bar;
// Bar

return $instance->baz;
// Baz

return $instance->qwerty;
// null
```

### Casts

```php
namespace App\DTO;

use DragonCode\SimpleDataTransferObject\DataTransferObject;
use DragonCode\Support\Facades\Helpers\Str;

class YourInstance extends DataTransferObject
{
    public $foo;

    public $bar;

    public $baz;

    public $qwerty;

    protected $map = [
        'data.foo' => 'foo',
        'data.bar' => 'bar',
    ];

    protected function castFoo($value)
    {
        return Str::upper($value);
    }
}

$instance = YourInstance::make([
    'data' => [
        'foo' => 'Foo',
        'bar' => 'Bar'
    ],
    'baz' => 'Baz'
]);


return $instance->foo;
// FOO

return $instance->bar;
// Bar

return $instance->baz;
// Baz

return $instance->qwerty;
// null
```

### Nested Objects

With the help of casts, you can also easily create nested objects:

```php
use Tests\Fixtures\Nested\Company;

$company = Company::make([
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
            ],
        ],
    ],
]);

$company->title;
// First Company

foreach ($company->projects as $project) {
    $project->title;
    // 0: Project 1

    foreach ($project->developers as $developer) {
        $developer->name;
        // 0: Andrey Helldar
        // 1: John Doe
    }
}
```

For example, casting test company object:

```php
namespace Tests\Fixtures\Nested;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class Company extends DataTransferObject
{
    public string $title;

    /** @var \Tests\Fixtures\Nested\Project[] */
    public array $projects;

    protected function castProjects(array $projects): array
    {
        return array_map(static function (array $project) {
            return Project::make($project);
        }, $projects);
    }
}
```

### From

#### Array

```php
use DragonCode\Contracts\DataTransferObject\DataTransferObject;
use Tests\Fixtures\Simple;

class Foo
{
    protected array $items = [
        'foo' => 'Foo',
        'bar' => 'Bar',
    ];

    protected function dto(): DataTransferObject
    {
        return Simple::fromArray($this->items);
    }
}
```

#### Json

```php
use DragonCode\Contracts\DataTransferObject\DataTransferObject;
use Tests\Fixtures\Simple;

class Foo
{
    protected string $json = '{"foo":"Foo","bar":"Bar"}';

    protected function dto(): DataTransferObject
    {
        return Simple::fromJson($this->json);
    }
}
```

#### Object

```php
use DragonCode\Contracts\DataTransferObject\DataTransferObject;
use Tests\Fixtures\CustomObject;
use Tests\Fixtures\Simple;

class Foo
{
    protected CustomObject $object;

    protected function dto(): DataTransferObject
    {
        return Simple::fromObject($this->object);
    }
}
```

#### Request

```php
use DragonCode\Contracts\DataTransferObject\DataTransferObject;
use Symfony\Component\HttpFoundation\Request;
use Tests\Fixtures\Simple;

class Foo
{
    protected Request $request;

    protected function dto(): DataTransferObject
    {
        return Simple::fromRequest($this->request)
    }
}
```

## Helpers

For your convenience, starting from version [2.17](https://github.com/TheDragonCode/contracts/releases/tag/v2.17.0) of
the [`dragon-code/contracts`](https://github.com/TheDragonCode/contracts/releases/tag/v2.17.0) package, we have added a new interface that declares the implementation of the
public `dto` method. This way you can better control your application to return DTO objects.

Of course, don't forget to implement the interface 😉

For example:

```php
namespace App\Http\Requests\Companies;

use App\Objects\Company;
use DragonCode\Contracts\DataTransferObject\DataTransferObject;
use DragonCode\Contracts\DataTransferObject\Dtoable;

class CreateRequest implements Dtoable
{
    // ...

    public function dto(): DataTransferObject
    {
        return Company::fromRequest($this);
    }
}

// Other place
public function store(CreateRequest $request)
{
    $name = $request->dto()->name;
}
```

[badge_downloads]:      https://img.shields.io/packagist/dt/dragon-code/simple-dto.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/dragon-code/simple-dto.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/TheDragonCode/simple-data-transfer-object?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/dragon-code/simple-dto
