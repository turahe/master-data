<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Turahe\Master\Models\Country;
use Turahe\Master\Models\Province;
use Turahe\Master\Tests\TestCase;

class CountryTest extends TestCase
{
    /** @test */
    public function a_country_has_many_provinces_relation()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $country = Country::find(104);

//        dd($country->provinces->first());

        $this->assertInstanceOf(Collection::class, $country->provinces);
//        $this->assertInstanceOf(Province::class, $country->provinces->first());
    }

    /** @test */
    public function a_country_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $country = Country::find(104);

        $this->assertEquals('Indonesia', $country->name);
    }

    /** @test */
    public function a_country_has_logo_path_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $country = Country::find(104);

        $this->assertNull($country->logo_path);
    }
}
