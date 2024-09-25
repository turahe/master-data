<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Village;
use Turahe\Master\Tests\TestCase;

class VillageTest extends TestCase
{
    #[Test]
    public function a_village_has_belongs_to_district_relation()
    {
        $district = District::create([
            'name' => 'Name',
            'code' => 1111222,
            'city_id' => 1111,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $village = Village::create([
            'name' => 'Village 1',
            'district_id' => $district->id,
            'code' => 1111222,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ]);

        $this->assertInstanceOf(District::class, $village->district);
        $this->assertEquals($village->district_id, $village->district->id);
    }

    #[Test]
    public function it_can_create_the_village()
    {
        [$data, $village] = $this->createData();

        $this->assertEquals($data['name'], $village->name);
        $this->assertEquals($data['district_id'], $village->district_id);
        $this->assertEquals($data['code'], $village->code);
        $this->assertEquals($data['latitude'], $village->latitude);
        $this->assertEquals($data['longitude'], $village->longitude);
    }

    #[Test]
    public function it_can_delete_a_village()
    {
        [$data, $village] = $this->createData();

        $deleted = $village->delete();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing(config('master.tables.villages'), ['name' => $village->name]);
    }

    #[Test]
    public function it_errors_when_updating_the_village()
    {
        [$data, $village] = $this->createData();
        $this->expectException(QueryException::class);

        $village->update(['name' => null]);
    }

    #[Test]
    public function it_can_update_the_village()
    {
        [$data, $village] = $this->createData();

        $update = ['code' => 'AFF'];
        $village->update($update);

        $this->assertEquals('AFF', $village->code);
    }

    #[Test]
    public function it_can_find_the_village()
    {
        [$data, $village] = $this->createData();

        $found = Village::where('code', $village->code)->first();

        $this->assertEquals($village->code, $found->code);
    }

    private function createData(): array
    {
        $data = [
            'name' => 'Village 1',
            'district_id' => 1111,
            'code' => 1111222,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $village = Village::create($data);

        return [$data, $village];
    }
}
