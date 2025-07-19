[![Total Downloads](https://poser.pugx.org/turahe/master-data/downloads)](//packagist.org/packages/turahe/master-data)
[![Version](https://poser.pugx.org/turahe/master-data/version)](//packagist.org/packages/turahe/master-data)
[![License](https://poser.pugx.org/turahe/master-data/license)](//packagist.org/packages/turahe/master-data)
[![Tests](https://github.com/turahe/master-data/workflows/Tests%20(Simple)/badge.svg)](https://github.com/turahe/master-data/actions/workflows/tests-simple.yml)
[![Code Quality](https://github.com/turahe/master-data/workflows/Code%20Quality/badge.svg)](https://github.com/turahe/master-data/actions/workflows/code-quality.yml)



Instalasi

## Instalasi

### Install Package Via Composer

```
composer require turahe/master-data
```

In Laravel 5.5 and higher versions, the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers' => [
    // ...
    Turahe\Master\MasterServiceProvider::class,
    //...
];
```

You must publish [the migration](https://github.com/turahe/master-data/tree/master/database/migrations) with:

```bash
php artisan vendor:publish --provider="Turahe\Master\MasterServiceProvider" --tag=assets
```

After the migration has been published you can create the tables by running the migrations:

```bash
php artisan migrate
```

### What does it gives you?

This package has all sorts of information about all:

| info            | items |
------------------|-------:|
| currencies      | 256   |
| countries       | 266   |
| timezones       | 423   |
| flags           | 1,570  |
| states          | 4,526  |
| cities          | 7,376  |
| timezones times | 81,153 |

## Testing

This package is tested against:

- **PHP**: 8.2, 8.3, 8.4
- **Laravel**: 10.x, 11.x, 12.x

The test matrix excludes incompatible combinations:
- Laravel 12.x requires PHP 8.3+
- Laravel 10.x doesn't support PHP 8.4

### Running Tests Locally

```bash
# Install dependencies
composer install

# Run tests
vendor/bin/phpunit

# Run code quality checks
vendor/bin/pint --test
vendor/bin/phpstan analyse src tests --level=8
```
