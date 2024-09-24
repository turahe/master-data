<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Turahe\Master\Models\Country;
use Turahe\Master\Models\Currency;
use Turahe\Master\Models\Language;
use Turahe\Master\Models\Province;
use Turahe\Master\Models\State;
use Turahe\Master\Tests\TestCase;

class CountryTest extends TestCase
{
    /** @test */
    public function a_country_has_many_provinces_relation()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CurrenciesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $country = Country::where('iso_3166_2', 'ID')->first();

        $this->assertInstanceOf(Collection::class, $country->provinces);
        $this->assertInstanceOf(Province::class, $country->provinces->first());
        $this->assertInstanceOf(Collection::class, $country->states);
        $this->assertInstanceOf(State::class, $country->states->first());
        $this->assertInstanceOf(Currency::class, $country->currency);
    }

    /** @test */
    public function a_country_has_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $country = Country::where('iso_3166_2', 'ID')->firstOrFail();

        $this->assertEquals('Republic of Indonesia', $country->full_name);
        $this->assertEquals('Jakarta', $country->capital);
        $this->assertEquals('Indonesian', $country->citizenship);
        $this->assertEquals('IDR', $country->currency_code);
        $this->assertEquals('sen (inv.)', $country->currency_sub_unit);
        $this->assertEquals('Rp', $country->currency_symbol);
        $this->assertEquals('ID', $country->iso_3166_2);
        $this->assertEquals('IDN', $country->iso_3166_3);
        $this->assertEquals('Indonesia', $country->name);
        $this->assertEquals('142', $country->region_code);
        $this->assertEquals('035', $country->sub_region_code);
        $this->assertTrue($country->eea);
        $this->assertEquals('62', $country->calling_code);
        $this->assertEquals('360', $country->country_code);
        $this->assertEquals(null, $country->latitude);
        $this->assertEquals(null, $country->longitude);
        $this->assertEquals(asset('vendor/assets/countries/flags/'.$country->code.'.png'), $country->flag);
    }

    /** @test */
    public function it_can_create_the_country()
    {
        $data = [
            'capital' => 'Jakarta',
            'citizenship' => 'Indonesian',
            'country_code' => '360',
            'currency_name' => 'Rupiah',
            'currency_code' => 'IDR',
            'currency_sub_unit' => 'sen (inv.)',
            'currency_symbol' => 'Rp',
            'full_name' => 'Republic of Indonesia',
            'iso_3166_2' => 'ID',
            'iso_3166_3' => 'IDN',
            'name' => 'Indonesia',
            'region_code' => '142',
            'sub_region_code' => '035',
            'eea' => true,
            'calling_code' => '62',
            'flag' => 'id.png',
            'latitude' => null,
            'longitude' => null,

        ];

        $country = Country::create($data);

        $this->assertEquals($data['capital'], $country->capital);
        $this->assertEquals($data['citizenship'], $country->citizenship);
        $this->assertEquals($data['country_code'], $country->country_code);
        $this->assertEquals($data['currency_name'], $country->currency_name);
        $this->assertEquals($data['currency_code'], $country->currency_code);
        $this->assertEquals($data['currency_sub_unit'], $country->currency_sub_unit);
        $this->assertEquals($data['currency_symbol'], $country->currency_symbol);
        $this->assertEquals($data['full_name'], $country->full_name);
        $this->assertEquals($data['iso_3166_2'], $country->iso_3166_2);
        $this->assertEquals($data['iso_3166_3'], $country->iso_3166_3);
        $this->assertEquals($data['name'], $country->name);
        $this->assertEquals($data['region_code'], $country->region_code);
        $this->assertEquals($data['sub_region_code'], $country->sub_region_code);
        $this->assertTrue($country->eea);
        $this->assertEquals($data['calling_code'], $country->calling_code);
        $this->assertEquals(asset('vendor/assets/countries/flags/'.$country->code.'.png'), $country->flag);
        $this->assertEquals($data['latitude'], $country->latitude);
        $this->assertEquals($data['longitude'], $country->longitude);
    }

    /** @test */
    public function it_can_delete_a_country()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $country = Language::first();

        $deleted = $country->delete();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing(config('master.tables.countries'), ['name' => $country->name]);
    }

    /** @test */
    public function it_errors_when_updating_the_country()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $country = Language::first();
        $this->expectException(QueryException::class);

        $country->update(['name' => null]);
    }

    /** @test */
    public function it_can_update_the_country()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $country = Language::first();

        $update = ['code' => 'AFF'];
        $country->update($update);

        $this->assertEquals('AFF', $country->code);
    }

    /** @test */
    public function it_can_find_the_country()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $country = Language::first();

        $found = Language::where('code', $country->code)->first();

        $this->assertEquals($country->code, $found->code);
    }
}
