<?php

namespace Turahe\Master\Test\Unit;

use Illuminate\Database\Eloquent\Collection;
use Turahe\Master\Models\Province;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Country;
use Turahe\Master\Test\TestCase;

class CountryTest extends TestCase
{
    /** @test */
    public function a_country_has_many_provinces_relation()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $country = Country::first();

        $this->assertInstanceOf(Collection::class, $country->provinces);
        $this->assertInstanceOf(Province::class, $country->provinces->first());
    }

    /** @test */
    public function a_country_has_many_districts_relation()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $country = Country::first();

        $this->assertInstanceOf(Collection::class, $country->districts);
        $this->assertInstanceOf(District::class, $country->districts->first());
    }

    /** @test */
    public function a_country_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $country = Country::first();

        $this->assertEquals('Bali', $country->name);
    }

    /** @test */
    public function a_country_has_logo_path_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $country = Country::first();

        $this->assertNull($country->logo_path);
    }

    /** @test */
//    public function a_country_can_store_meta_column()
//    {
//        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
//        $country = Country::first();
//        $country->meta = ['luas_wilayah' => 200.2];
//        $country->save();
//        $this->assertEquals(['luas_wilayah' => 200.2], $country->meta);
//    }
}
