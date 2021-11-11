# Simple Data Transfer Object

<img src="https://preview.dragon-code.pro/TheDragonCode/simple-dto.svg?brand=php" alt="Simple DTO"/>

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Installation

To get the latest version of `Simple Data Transfer Object`, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require dragon-code/simple-data-transfer-object
```

Or manually update `require` block of `composer.json` and run `composer update`.

```json
{
    "require": {
        "dragon-code/simple-data-transfer-object": "^2.0"
    }
}
```

### Upgrade from `andrey-helldar/simple-data-transfer-object`

1. Replace `"andrey-helldar/simple-data-transfer-object": "^1.0"` with `"dragon-code/simple-data-transfer-object": "^2.0"` in the composer.json file;
2. Replace `Helldar\SimpleDataTransferObject` namespace prefix with `DragonCode\SimpleDataTransferObject` in your application;
3. Call the `composer update` console command.

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

[badge_downloads]:      https://img.shields.io/packagist/dt/dragon-code/simple-data-transfer-object.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/dragon-code/simple-data-transfer-object.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/dragon-code/simple-data-transfer-object?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/dragon-code/simple-data-transfer-object
