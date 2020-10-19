<?php

namespace Turahe\Master\Test\Models;

use Illuminate\Database\Eloquent\Collection;
use Turahe\Master\Models\City;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Province;
use Turahe\Master\Models\Village;
use Turahe\Master\Test\TestCase;

class CityTest extends TestCase
{
    /** @test */
    public function a_city_has_belongs_to_province_relation()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $this->assertInstanceOf(Province::class, $city->province);
        $this->assertEquals($city->province_id, $city->province->id);
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

        $this->assertEquals('KABUPATEN SIMEULUE', $city->name);
    }

    /** @test */
    public function a_city_has_province_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $this->assertEquals('ACEH', $city->province_name);
    }

    /** @test */
    public function a_city_has_logo_path_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $this->assertNull($city->logo_path);
    }

    /** @test */
    public function a_city_can_store_meta_column()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();
        $city->meta = ['luas_wilayah' => 200.2];
        $city->save();
        $this->assertEquals(['luas_wilayah' => 200.2], $city->meta);
    }
}
