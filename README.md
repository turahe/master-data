[![Total Downloads](https://poser.pugx.org/turahe/master-data/downloads)](//packagist.org/packages/turahe/master-data)
[![Version](https://poser.pugx.org/turahe/master-data/version)](//packagist.org/packages/turahe/master-data)
[![License](https://poser.pugx.org/turahe/master-data/license)](//packagist.org/packages/turahe/master-data)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/turahe/master-data/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/turahe/master-data/?branch=master)
[![Build Status](https://travis-ci.org/turahe/master-data.svg?branch=master)](https://travis-ci.org/turahe/master-data)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fturahe%2Fmaster-data.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Fturahe%2Fmaster-data?ref=badge_shield)
[![StyleCI](https://github.styleci.io/repos/300819171/shield?branch=master)](https://github.styleci.io/repos/300819171?branch=master)
![PHP Composer](https://github.com/turahe/master-data/workflows/PHP%20Composer/badge.svg)



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
