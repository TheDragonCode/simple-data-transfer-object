# Simple Data Transfer Object

<img src="https://preview.dragon-code.pro/TheDragonCode/simple-dto.svg?brand=php" alt="Simple DTO"/>

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Installation

To get the latest version of `Simple Data Transfer Object`, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require andrey-helldar/simple-data-transfer-object
```

Or manually update `require` block of `composer.json` and run `composer update`.

```json
{
    "require": {
        "andrey-helldar/simple-data-transfer-object": "^1.0"
    }
}
```

## Using

```php
namespace App\DTO;

use Helldar\SimpleDataTransferObject\DataTransferObject;

class YourInstance extends DataTransferObject
{
    public $foo;
   
    protected $bar;
    
    protected $baz;
   
    protected $map = [
        'data.foo' => 'foo',
        'data.bar' => 'bar',
    ];
}

return YourInstance::make([
    'data' => [
        'foo' => 'Foo',
        'bar' => 'Bar'
    ],
    'baz' => 'Baz'
]);


// public $foo = 'Foo';
// protected $bar = 'Bar';
// protected $baz = 'Baz';
```

[badge_downloads]:      https://img.shields.io/packagist/dt/andrey-helldar/simple-data-transfer-object.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/andrey-helldar/simple-data-transfer-object.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/andrey-helldar/simple-data-transfer-object?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/andrey-helldar/simple-data-transfer-object
