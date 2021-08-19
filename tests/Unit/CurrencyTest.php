<?php


namespace Turahe\Master\Test\Unit;

use Turahe\Master\Models\Currency;
use Turahe\Master\Test\TestCase;

class CurrencyTest extends TestCase
{
    /** @test */
    public function a_currency_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $currency = Currency::first();

        $this->assertEquals('United Arab Emirates Dirham', $currency->name);
    }

    /** @test */
    public function a_currency_has_iso_code_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $currency = Currency::first();

        $this->assertEquals('AED', $currency->iso_code);
    }
    /** @test */
    public function a_currency_has_symbol_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $currency = Currency::first();

        $this->assertEquals('د.إ', $currency->symbol);
    }
    /** @test */
    public function a_currency_has_iso_numeric_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $currency = Currency::first();

        $this->assertEquals('784', $currency->iso_numeric);
    }
}
