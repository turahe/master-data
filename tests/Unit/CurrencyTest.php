<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Master\Models\Country;
use Turahe\Master\Models\Currency;
use Turahe\Master\Tests\TestCase;

class CurrencyTest extends TestCase
{
    #[Test]
    public function a_currency_has_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $currency = Currency::first();

        $this->assertEquals('United Arab Emirates Dirham', $currency->name);
        $this->assertEquals('AED', $currency->iso_code);
        $this->assertEquals('د.إ', $currency->symbol);
        $this->assertEquals('784', $currency->iso_numeric);
        $this->assertInstanceOf(Country::class, $currency->country);
    }

    #[Test]
    public function it_can_create_the_currency()
    {
        $data = [
            'name' => 'Indonesia Rupiah',
            'iso_code' => 'IDR',
            'symbol' => 'Rp',
            'iso_numeric' => '723',
        ];

        $currency = Currency::create($data);

        $this->assertEquals($data['name'], $currency->name);
        $this->assertEquals($data['iso_code'], $currency->iso_code);
        $this->assertEquals($data['symbol'], $currency->symbol);
        $this->assertEquals($data['iso_numeric'], $currency->iso_numeric);
    }

    #[Test]
    public function it_can_delete_a_currency()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $currency = Currency::first();

        $deleted = $currency->delete();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing(config('master.tables.currencies'), ['name' => $currency->name]);
    }

    #[Test]
    public function it_errors_when_updating_the_currency()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $currency = Currency::first();
        $this->expectException(QueryException::class);

        $currency->update(['iso_code' => null]);
    }

    #[Test]
    public function it_can_update_the_currency()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $currency = Currency::first();

        $update = ['iso_code' => 'WWW'];
        $currency->update($update);

        $this->assertEquals('WWW', $currency->iso_code);
    }

    #[Test]
    public function it_can_find_the_currency()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $currency = Currency::first();

        $found = Currency::where('iso_code', $currency->iso_code)->first();

        $this->assertEquals($currency->iso_code, $found->iso_code);
    }
}
