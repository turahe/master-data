<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Turahe\Master\Models\City;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Village;
use Turahe\Master\Tests\TestCase;

class DistrictTest extends TestCase
{
    /** @test */
    public function a_district_has_belongs_to_city_relation()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $district = District::first();

        $this->assertInstanceOf(City::class, $district->city);
        $this->assertEquals($district->city_id, $district->city->id);
    }

    /** @test */
    public function a_district_has_many_villages_relation()
    {
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $this->seed('Turahe\Master\Seeds\VillagesTableSeeder');
        $district = District::first();

        $this->assertInstanceOf(Collection::class, $district->villages);
        $this->assertInstanceOf(Village::class, $district->villages->first());
    }

    /** @test */
    public function a_district_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $district = District::first();

        $this->assertEquals('TEUPAH SELATAN', $district->name);
    }

    /** @test */
    public function a_district_has_city_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $district = District::first();

        $this->assertEquals('KABUPATEN SIMEULUE', $district->city->name);
    }

    /** @test */
    public function a_district_has_province_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $district = District::first();

        $this->assertEquals('ACEH', $district->province->name);
    }

    /** @test */
    //    public function a_district_can_store_meta_column()
    //    {
    //        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
    //        $district = District::first();
    //        $district->meta = ['luas_wilayah' => 200.2];
    //        $district->save();
    //        $this->assertEquals(['luas_wilayah' => 200.2], $district->meta);
    //    }
}
