<?php
namespace Turahe\Master\Tests\Unit;

use Turahe\Master\Models\City;
use Turahe\Master\Models\State;
use Turahe\Master\Models\Village;
use Turahe\Master\Tests\TestCase;
use Turahe\Master\Models\District;
use Illuminate\Database\Eloquent\Collection;

class CityTest extends TestCase
{
    /** @test */
    public function a_city_has_belongs_to_province_relation()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $this->assertInstanceOf(State::class, $city->state);
        $this->assertEquals($city->state_id, $city->state->id);
    }

    /** @test */
    public function a_city_has_many_districts_relation()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $city = City::first();

        $this->assertInstanceOf(Collection::class, $city->districts);
        $this->assertInstanceOf(District::class, $city->districts->first());
    }

    /** @test */
    public function a_city_has_many_villages_relation()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $this->seed('Turahe\Master\Seeds\VillagesTableSeeder');
        $city = City::first();

        $this->assertInstanceOf(Collection::class, $city->villages);
        $this->assertInstanceOf(Village::class, $city->villages->first());
    }

    /** @test */
    public function a_city_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $this->assertEquals('Aceh Barat', $city->name);
    }

    /** @test */
    public function a_city_has_province_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $this->assertEquals('Nanggroe Aceh Darussalam (NAD)', $city->state->name);
    }

    /** @test */
    public function a_city_has_logo_path_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $this->assertNull($city->logo_path);
    }
}
