<?php

namespace Turahe\Master\Test\Models;

use Turahe\Master\Models\District;
use Turahe\Master\Models\Village;
use Turahe\Master\Test\TestCase;

class VillageTest extends TestCase
{
    /** @test */
    public function a_village_has_belongs_to_distict_relation()
    {
        $this->seed('Turahe\Master\Seeds\DistrictsSeeder');
        $this->seed('Turahe\Master\Seeds\VillagesSeeder');
        $village = Village::first();

        $this->assertInstanceOf(District::class, $village->district);
        $this->assertEquals($village->district_id, $village->district->id);
    }

    /** @test */
    public function a_village_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\VillagesSeeder');
        $village = Village::first();

        $this->assertEquals('LATIUNG', $village->name);
    }

    /** @test */
    public function a_village_has_district_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\DistrictsSeeder');
        $this->seed('Turahe\Master\Seeds\VillagesSeeder');
        $village = Village::first();

        $this->assertEquals('TEUPAH SELATAN', $village->district_name);
    }

    /** @test */
    public function a_village_has_city_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CitiesSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsSeeder');
        $this->seed('Turahe\Master\Seeds\VillagesSeeder');
        $village = Village::first();

        $this->assertEquals('KABUPATEN SIMEULUE', $village->city_name);
    }

    /** @test */
    public function a_village_has_province_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\ProvincesSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesSeeder');
        $this->seed('Turahe\Master\Seeds\DistrictsSeeder');
        $this->seed('Turahe\Master\Seeds\VillagesSeeder');
        $village = Village::first();

        $this->assertEquals('ACEH', $village->province_name);
    }

    /** @test */
    public function a_village_can_store_meta_column()
    {
        $this->seed('Turahe\Master\Seeds\VillagesSeeder');
        $village = Village::first();
        $village->meta = ['luas_wilayah' => 200.2];
        $village->save();
        $this->assertEquals(['luas_wilayah' => 200.2], $village->meta);
    }
}
