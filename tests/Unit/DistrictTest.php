<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Village;
use Turahe\Master\Tests\TestCase;

class DistrictTest extends TestCase
{
    /** @test */
    public function a_district_has_many_villages_relation()
    {
        $district = District::create([
            'name' => 'Name',
            'code' => 1111222,
            'city_id' => 1111,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $villages = Village::create([
            'name' => 'Village 1',
            'district_id' => $district->id,
            'code' => 1111222,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);
        $this->assertInstanceOf(Collection::class, $district->villages);
        $this->assertInstanceOf(Village::class, $district->villages->first());
    }

    /** @test */
    public function a_create_district()
    {
        $data = [
            'name' => 'Name',
            'city_id' => 1111,
            'code' => 1111222,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $district = District::create($data);

        $this->assertEquals($data['city_id'], $district->city_id);
        $this->assertEquals($data['name'], $district->name);
        $this->assertEquals($data['latitude'], $district->latitude);
        $this->assertEquals($data['longitude'], $district->longitude);
    }

    /** @test */
    public function it_can_delete_a_district()
    {
        $district = District::create([
            'name' => 'Name',
            'city_id' => 1111,
            'code' => 1111222,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $villages = Village::create([
            'name' => 'Village 1',
            'code' => 1111222,
            'district_id' => $district->id,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $deleted = $district->delete();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing(config('master.tables.districts'), ['name' => $district->name]);
    }

    /** @test */
    public function it_errors_when_updating_the_district()
    {
        $district = District::create([
            'name' => 'Name',
            'city_id' => 1111,
            'code' => 1111222,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);
        $this->expectException(QueryException::class);

        $district->update(['name' => null]);
    }

    /** @test */
    public function it_can_update_the_district()
    {
        $district = District::create([
            'name' => 'Name',
            'city_id' => 1111,
            'code' => 1111222,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $update = ['code' => '1234'];
        $district->update($update);

        $this->assertEquals('1234', $district->code);
    }

    /** @test */
    public function it_can_find_the_district()
    {
        $district = District::create([
            'name' => 'Name',
            'city_id' => 1111,
            'code' => 1111222,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $found = District::where('code', $district->code)->first();

        $this->assertEquals($district->code, $found->code);
    }
}
