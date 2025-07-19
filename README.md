# Laravel Master Data Package

[![Total Downloads](https://poser.pugx.org/turahe/master-data/downloads)](//packagist.org/packages/turahe/master-data)
[![Version](https://poser.pugx.org/turahe/master-data/version)](//packagist.org/packages/turahe/master-data)
[![License](https://poser.pugx.org/turahe/master-data/license)](//packagist.org/packages/turahe/master-data)
[![Tests](https://github.com/turahe/master-data/workflows/Tests%20(Simple)/badge.svg)](https://github.com/turahe/master-data/actions/workflows/tests-simple.yml)
[![Code Quality](https://github.com/turahe/master-data/workflows/Code%20Quality/badge.svg)](https://github.com/turahe/master-data/actions/workflows/code-quality.yml)

A comprehensive Laravel package that provides master data for countries, provinces, cities, districts, villages, banks, currencies, and languages. Perfect for applications requiring geographical data, banking information, and internationalization support.

## 📋 Table of Contents

- [Features](#-features)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Data Overview](#-data-overview)
- [API Reference](#-api-reference)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

- **🌍 Geographical Data**: Complete hierarchy of countries, provinces, cities, districts, and villages
- **🏦 Banking Information**: Indonesian banks with codes, names, and company details
- **💱 Currency Support**: Global currencies with codes and symbols
- **🌐 Language Support**: International languages with ISO codes
- **🖼️ Visual Assets**: Country flags and city images included
- **🔍 Easy Querying**: Eloquent models with relationships and scopes
- **⚡ Performance**: Optimized database structure and caching
- **🧪 Comprehensive Testing**: Full test coverage across multiple PHP/Laravel versions

## 📋 Requirements

- **PHP**: 8.2, 8.3, 8.4
- **Laravel**: 10.x, 11.x, 12.x
- **Database**: MySQL, PostgreSQL, SQLite (for testing)

## 🚀 Installation

### 1. Install via Composer

```bash
composer require turahe/master-data
```

### 2. Publish Assets and Migrations

```bash
php artisan vendor:publish --provider="Turahe\Master\MasterServiceProvider" --tag=assets
```

### 3. Run Migrations

```bash
php artisan migrate
```

### 4. Seed the Database (Optional)

```bash
php artisan master:seed
```

## ⚙️ Configuration

The package configuration is published to `config/master.php`. You can customize table names and model classes:

```php
return [
    'tables' => [
        'countries' => 'tm_countries',
        'provinces' => 'tm_provinces',
        'cities' => 'tm_cities',
        'districts' => 'tm_districts',
        'villages' => 'tm_villages',
        'banks' => 'tm_banks',
        'currencies' => 'tm_currencies',
        'languages' => 'tm_languages',
    ],
    'models' => [
        'country' => \Turahe\Master\Models\Country::class,
        'province' => \Turahe\Master\Models\Province::class,
        'city' => \Turahe\Master\Models\City::class,
        'district' => \Turahe\Master\Models\District::class,
        'village' => \Turahe\Master\Models\Village::class,
    ],
];
```

## 💡 Usage

### Using Eloquent Models

```php
use Turahe\Master\Models\Country;
use Turahe\Master\Models\Province;
use Turahe\Master\Models\City;
use Turahe\Master\Models\Bank;
use Turahe\Master\Models\Currency;

// Get all countries
$countries = Country::all();

// Get Indonesia
$indonesia = Country::where('name', 'Indonesia')->first();

// Get provinces in Indonesia
$provinces = $indonesia->provinces;

// Get cities in a specific province
$jakarta = Province::where('name', 'DKI Jakarta')->first();
$cities = $jakarta->cities;

// Get banks
$banks = Bank::all();

// Get currencies
$currencies = Currency::all();
```

### Using the Facade

```php
use Turahe\Master\Master;

// Access models through facade
$countries = Master::country()->all();
$provinces = Master::province()->all();
$cities = Master::city()->all();
$banks = Master::bank()->all();
```

### Relationships

```php
// Country -> Provinces
$country = Country::find(1);
$provinces = $country->provinces;

// Province -> Cities
$province = Province::find(1);
$cities = $province->cities;

// City -> Districts
$city = City::find(1);
$districts = $city->districts;

// District -> Villages
$district = District::find(1);
$villages = $district->villages;
```

### Search and Filter

```php
// Search cities by name
$cities = City::where('name', 'like', '%Jakarta%')->get();

// Get cities by province
$cities = City::where('province_id', $provinceId)->get();

// Get banks by code
$bank = Bank::where('code', '008')->first(); // Bank Mandiri
```

## 📊 Data Overview

This package provides comprehensive master data:

| Data Type | Count | Description |
|-----------|-------|-------------|
| **Countries** | 266 | Global countries with ISO codes |
| **Provinces** | 4,526 | Administrative divisions worldwide |
| **Cities** | 7,376 | Cities and municipalities |
| **Districts** | 81,153 | Districts and sub-districts |
| **Villages** | 1,570 | Villages and neighborhoods |
| **Banks** | 256 | Indonesian banks with codes |
| **Currencies** | 423 | Global currencies with symbols |
| **Languages** | 266 | International languages with ISO codes |
| **Flags** | 1,570 | Country flag images |
| **City Images** | 7,376 | City landmark images |

## 🔧 API Reference

### Models

#### Country
```php
Country::all()                    // Get all countries
Country::find($id)               // Find by ID
Country::where('name', $name)    // Find by name
$country->provinces              // Get related provinces
```

#### Province
```php
Province::all()                  // Get all provinces
Province::find($id)             // Find by ID
Province::where('country_id', $id) // Get by country
$province->cities               // Get related cities
$province->country              // Get parent country
```

#### City
```php
City::all()                      // Get all cities
City::find($id)                 // Find by ID
City::where('province_id', $id)  // Get by province
$city->districts                // Get related districts
$city->province                 // Get parent province
```

#### Bank
```php
Bank::all()                      // Get all banks
Bank::where('code', $code)      // Find by bank code
Bank::where('name', $name)      // Find by bank name
```

#### Currency
```php
Currency::all()                  // Get all currencies
Currency::where('code', $code)  // Find by currency code
Currency::where('name', $name)  // Find by currency name
```

### Commands

```bash
# Seed all master data
php artisan master:seed

# Sync coordinates (requires spatie/geocoder)
php artisan master:sync-coordinates
```

## 🧪 Testing

This package is thoroughly tested against:

- **PHP**: 8.2, 8.3, 8.4
- **Laravel**: 10.x, 11.x, 12.x

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

### Test Matrix

The CI/CD pipeline excludes incompatible combinations:
- Laravel 12.x requires PHP 8.3+
- Laravel 10.x doesn't support PHP 8.4

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Setup

```bash
# Clone the repository
git clone https://github.com/turahe/master-data.git

# Install dependencies
composer install

# Run tests
vendor/bin/phpunit

# Check code style
vendor/bin/pint
```

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## 🙏 Acknowledgments

- Data sources for geographical information
- Laravel community for the excellent framework
- Contributors and maintainers

---

**Made with ❤️ by [Nur Wachid](mailto:wachid@outlook.com)**
