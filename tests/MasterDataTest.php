<?php

namespace Turahe\Master\Test;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class MasterDataTest extends TestCase
{
    use InteractsWithDatabase;

    /** @test */
    public function it_can_call_master_service()
    {
        $this->artisan('turahe:master:seed');

        $this->checkProvinces();
        $this->checkCities();
        $this->checkDistricts();
        // $this->checkVillages();
        $this->search();
    }

    public function checkProvinces()
    {
        $results = \Master::allProvinces();

        $this->assertNotEmpty($results);

        $results = \Master::paginateProvinces();

        $this->assertEquals(count($results), 15);

        // array $with : cities, districts, villages, cities.districts, cities.districts.villages, districts.villages

        $selectedProvinceId = $results[0]->id;

        $result = \Master::findProvince($selectedProvinceId);

        $this->assertEquals($result->id, $selectedProvinceId);

        $result = \Master::findProvince($selectedProvinceId, ['cities']);

        $this->assertNotEmpty($result->cities);

        $result = \Master::findProvince($selectedProvinceId, ['districts']);

        $this->assertNotEmpty($result->districts);

        $result = \Master::findProvince($selectedProvinceId, ['villages']);

        $this->assertNotEmpty($result->villages);

        $result = \Master::findProvince($selectedProvinceId, ['cities', 'districts.villages']);

        $this->assertNotEmpty($result->cities);
        $this->assertNotEmpty($result->districts);
        $this->assertNotEmpty($result->districts[0]->villages);

        $result = \Master::findProvince($selectedProvinceId, ['cities.districts']);

        $this->assertNotEmpty($result->cities[0]->districts);

        $result = \Master::findProvince($selectedProvinceId, ['cities.districts.villages']);

        $this->assertNotEmpty($result->cities[0]->districts[0]->villages);
    }

    public function checkCities()
    {
        $results = \Master::allCities();

        $this->assertNotEmpty($results);

        $results = \Master::paginateCities();

        $this->assertEquals(count($results), 15);

        // array $with : provinces, districts, villages, districts.villages

        $selectedCityId = $results[0]->id;

        $result = \Master::findCity($selectedCityId);

        $this->assertEquals($result->id, $selectedCityId);

        $result = \Master::findCity($selectedCityId, ['provinces']);

        $this->assertNotEmpty($result->province);

        $result = \Master::findCity($selectedCityId, ['districts']);

        $this->assertNotEmpty($result->districts);

        $result = \Master::findCity($selectedCityId, ['villages']);

        $this->assertNotEmpty($result->villages);

        $result = \Master::findCity($selectedCityId, ['districts.villages']);

        $this->assertNotEmpty($result->districts);
        $this->assertNotEmpty($result->districts[0]->villages);
    }

    public function checkDistricts()
    {
        $results = \Master::allDistricts();

        $this->assertNotEmpty($results);

        $results = \Master::paginateDistricts();

        $this->assertEquals(count($results), 15);

        // array $with : provinces, cities, cities.provinces, villages

        $selectedDistrictId = $results[0]->id;

        $result = \Master::findDistrict($selectedDistrictId);

        $this->assertEquals($result->id, $selectedDistrictId);

        $result = \Master::findDistrict($selectedDistrictId, ['provinces']);

        $this->assertNotEmpty($result->province);

        $result = \Master::findDistrict($selectedDistrictId, ['cities']);

        $this->assertNotEmpty($result->city);

        $result = \Master::findDistrict($selectedDistrictId, ['cities.provinces']);

        $this->assertNotEmpty($result->city);
        $this->assertNotEmpty($result->city->province);

        $result = \Master::findDistrict($selectedDistrictId, ['villages']);

        $this->assertNotEmpty($result->villages);
    }

    public function checkVillages()
    {
        $results = \Master::allVillages();

        $this->assertNotEmpty($results);

        $results = \Master::paginateVillages();

        $this->assertEquals(count($results), 15);

        // array $with : provinces, cities, districts, districts.cities, districts.cities.provinces

        $selectedVillageId = $results[0]->id;

        $result = \Master::findVillage($selectedVillageId);

        $this->assertEquals($result->id, $selectedVillageId);

        $result = \Master::findVillage($selectedVillageId, ['provinces']);

        $this->assertNotEmpty($result->province);

        $result = \Master::findVillage($selectedVillageId, ['cities']);

        $this->assertNotEmpty($result->city);

        $result = \Master::findVillage($selectedVillageId, ['districts.cities']);

        $this->assertNotEmpty($result->district);
        $this->assertNotEmpty($result->district->city);

        $result = \Master::findVillage($selectedVillageId, ['districts.cities.provinces']);

        $this->assertNotEmpty($result->district);
        $this->assertNotEmpty($result->district->city);
        $this->assertNotEmpty($result->district->city->province);
    }

    public function search()
    {
        $results = \Master::search('BATAM')->all();

        $this->assertNotEmpty($results);
    }
}
