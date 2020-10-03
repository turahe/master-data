<?php

namespace Turahe\Address\Test;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class AddressTest extends TestCase
{
    use InteractsWithDatabase;

    /** @test */
    public function it_can_call_indonesia_service()
    {
        $this->artisan('laravolt:indonesia:seed');

        $this->checkProvinces();
        $this->checkCities();
        $this->checkDistricts();
        // $this->checkVillages();
        $this->search();
    }

    public function checkProvinces()
    {
        $results = \Address::allProvinces();

        $this->assertNotEmpty($results);

        $results = \Address::paginateProvinces();

        $this->assertEquals(count($results), 15);

        // array $with : cities, districts, villages, cities.districts, cities.districts.villages, districts.villages

        $selectedProvinceId = $results[0]->id;

        $result = \Address::findProvince($selectedProvinceId);

        $this->assertEquals($result->id, $selectedProvinceId);

        $result = \Address::findProvince($selectedProvinceId, ['cities']);

        $this->assertNotEmpty($result->cities);

        $result = \Address::findProvince($selectedProvinceId, ['districts']);

        $this->assertNotEmpty($result->districts);

        $result = \Address::findProvince($selectedProvinceId, ['villages']);

        $this->assertNotEmpty($result->villages);

        $result = \Address::findProvince($selectedProvinceId, ['cities', 'districts.villages']);

        $this->assertNotEmpty($result->cities);
        $this->assertNotEmpty($result->districts);
        $this->assertNotEmpty($result->districts[0]->villages);

        $result = \Address::findProvince($selectedProvinceId, ['cities.districts']);

        $this->assertNotEmpty($result->cities[0]->districts);

        $result = \Address::findProvince($selectedProvinceId, ['cities.districts.villages']);

        $this->assertNotEmpty($result->cities[0]->districts[0]->villages);
    }

    public function checkCities()
    {
        $results = \Address::allCities();

        $this->assertNotEmpty($results);

        $results = \Address::paginateCities();

        $this->assertEquals(count($results), 15);

        // array $with : provinces, districts, villages, districts.villages

        $selectedCityId = $results[0]->id;

        $result = \Address::findCity($selectedCityId);

        $this->assertEquals($result->id, $selectedCityId);

        $result = \Address::findCity($selectedCityId, ['provinces']);

        $this->assertNotEmpty($result->province);

        $result = \Address::findCity($selectedCityId, ['districts']);

        $this->assertNotEmpty($result->districts);

        $result = \Address::findCity($selectedCityId, ['villages']);

        $this->assertNotEmpty($result->villages);

        $result = \Address::findCity($selectedCityId, ['districts.villages']);

        $this->assertNotEmpty($result->districts);
        $this->assertNotEmpty($result->districts[0]->villages);
    }

    public function checkDistricts()
    {
        $results = \Address::allDistricts();

        $this->assertNotEmpty($results);

        $results = \Address::paginateDistricts();

        $this->assertEquals(count($results), 15);

        // array $with : provinces, cities, cities.provinces, villages

        $selectedDistrictId = $results[0]->id;

        $result = \Address::findDistrict($selectedDistrictId);

        $this->assertEquals($result->id, $selectedDistrictId);

        $result = \Address::findDistrict($selectedDistrictId, ['provinces']);

        $this->assertNotEmpty($result->province);

        $result = \Address::findDistrict($selectedDistrictId, ['cities']);

        $this->assertNotEmpty($result->city);

        $result = \Address::findDistrict($selectedDistrictId, ['cities.provinces']);

        $this->assertNotEmpty($result->city);
        $this->assertNotEmpty($result->city->province);

        $result = \Address::findDistrict($selectedDistrictId, ['villages']);

        $this->assertNotEmpty($result->villages);
    }

    public function checkVillages()
    {
        $results = \Address::allVillages();

        $this->assertNotEmpty($results);

        $results = \Address::paginateVillages();

        $this->assertEquals(count($results), 15);

        // array $with : provinces, cities, districts, districts.cities, districts.cities.provinces

        $selectedVillageId = $results[0]->id;

        $result = \Address::findVillage($selectedVillageId);

        $this->assertEquals($result->id, $selectedVillageId);

        $result = \Address::findVillage($selectedVillageId, ['provinces']);

        $this->assertNotEmpty($result->province);

        $result = \Address::findVillage($selectedVillageId, ['cities']);

        $this->assertNotEmpty($result->city);

        $result = \Address::findVillage($selectedVillageId, ['districts.cities']);

        $this->assertNotEmpty($result->district);
        $this->assertNotEmpty($result->district->city);

        $result = \Address::findVillage($selectedVillageId, ['districts.cities.provinces']);

        $this->assertNotEmpty($result->district);
        $this->assertNotEmpty($result->district->city);
        $this->assertNotEmpty($result->district->city->province);
    }

    public function search()
    {
        $results = \Address::search('BATAM')->all();

        $this->assertNotEmpty($results);
    }
}
