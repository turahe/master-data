<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Turahe\Master\Models\City;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Province;
use Turahe\Master\Models\State;
use Turahe\Master\Tests\TestCase;

class CityTest extends TestCase
{
    /** @test */
    public function a_city_has_belongs_to_province_relation()
    {
        $province = Province::create([
            'country_id' => '100',
            'name' => $this->faker->country,
            'region' => '12',
            'iso_3166_2' => '12',
            'code' => '11',
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,

        ]);
        $city = City::create([
            'province_id' => $province->id,
            'name' => $this->faker->city,
            'type' => 'CITY',
            'code' => '11',
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $this->assertInstanceOf(State::class, $city->province);
        $this->assertEquals($city->province_id, $city->province->id);
    }

    /** @test */
    public function a_city_has_many_districts_relation()
    {
        $city = City::create([
            'province_id' => 1,
            'name' => $this->faker->city,
            'type' => 'CITY',
            'code' => '11',
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        District::create([
            'city_id' => $city->id,
            'name' => $this->faker->city,
            'code' => '11',
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $this->assertInstanceOf(Collection::class, $city->districts);
        $this->assertInstanceOf(District::class, $city->districts->first());
    }

    /** @test */
    public function a_create_city()
    {
        $data = [
            'province_id' => 1,
            'name' => $this->faker->city,
            'type' => 'CITY',
            'code' => '11',
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $city = City::create($data);

        $this->assertEquals($data['province_id'], $city->province_id);
        $this->assertEquals($data['name'], $city->name);
        $this->assertEquals($data['type'], $city->type);
        $this->assertEquals($data['code'], $city->code);
        $this->assertEquals($data['latitude'], $city->latitude);
        $this->assertEquals($data['longitude'], $city->longitude);
    }

    /** @test */
    public function it_can_delete_a_city()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $deleted = $city->delete();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing(config('master.tables.citys'), ['name' => $city->name]);
    }

    /** @test */
    public function it_errors_when_updating_the_city()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();
        $this->expectException(QueryException::class);

        $city->update(['name' => null]);
    }

    /** @test */
    public function it_can_update_the_city()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $update = ['code' => 'AFF'];
        $city->update($update);

        $this->assertEquals('AFF', $city->code);
    }

    /** @test */
    public function it_can_find_the_city()
    {
        $this->seed('Turahe\Master\Seeds\CitiesTableSeeder');
        $city = City::first();

        $found = City::where('code', $city->code)->first();

        $this->assertEquals($city->code, $found->code);
    }
}
