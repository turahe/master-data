<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Turahe\Master\Models\City;
use Turahe\Master\Models\Country;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Province;
use Turahe\Master\Tests\TestCase;

class ProvinceTest extends TestCase
{
    /** @test */
    public function a_province_has_many_cities_relation()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $province = Province::first();

        $this->assertInstanceOf(Country::class, $province->country);
        $this->assertInstanceOf(Collection::class, $province->cities);
        $this->assertInstanceOf(City::class, $province->cities->first());
        $this->assertInstanceOf(Collection::class, $province->districts);
    }

    /** @test */
    public function a_province_has_many_districts_relation()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        //        $this->seed('Turahe\Master\Seeds\DistrictsTableSeeder');
        $province = Province::first();

        $this->assertInstanceOf(Collection::class, $province->districts);
        //        $this->assertInstanceOf(District::class, $province->districts->first());
    }

    /** @test */
    public function a_province_has_attribute()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $province = Province::first();
        $country = $province->country;

        $this->assertEquals('98', $province->country_id);
        $this->assertEquals('Aceh (Nad)', $province->name);
        $this->assertEquals('11', $province->code);
    }

    /** @test */
    public function it_can_create_the_province()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $country = Country::first();
        $data = [
            'country_id' => $country->id,
            'name' => 'new Province',
            'code' => '11',
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,

        ];

        $province = Province::create($data);

        $this->assertEquals($data['country_id'], $province->country_id);
        $this->assertEquals($data['name'], $province->name);
        $this->assertEquals($data['code'], $province->code);
        $this->assertEquals($data['latitude'], $province->latitude);
        $this->assertEquals($data['longitude'], $province->longitude);
    }

    /** @test */
    public function it_can_delete_a_province()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $province = Province::first();

        $deleted = $province->delete();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing(config('master.tables.provinces'), ['name' => $province->name]);
    }

    /** @test */
    public function it_errors_when_updating_the_province()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $province = Province::first();
        $this->expectException(QueryException::class);

        $province->update(['name' => null]);
    }

    /** @test */
    public function it_can_update_the_province()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $province = Province::first();

        $update = ['code' => '11'];
        $province->update($update);

        $this->assertEquals('11', $province->code);
    }

    /** @test */
    public function it_can_find_the_province()
    {
        $this->seed('Turahe\Master\Seeds\CountriesTableSeeder');
        $this->seed('Turahe\Master\Seeds\ProvincesTableSeeder');
        $province = Province::first();

        $found = Province::where('code', $province->code)->first();

        $this->assertEquals($province->code, $found->code);
    }
}
