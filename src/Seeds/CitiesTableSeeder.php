<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\City;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__.'/../../resources/cities.json';
        $data = json_decode(file_get_contents($file), true);
        $cities = array_map(function ($arr) {
            return [
                'state_id' => $arr['state_id'],
                'name' => $arr['name'],
                'type' => $arr['type'] ?? null,
                'postal_code' => $arr['postal_code'],
                'latitude' => $arr['latitude'],
                'longitude' => $arr['longitude'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }, $data);

        foreach (array_chunk($cities, 30) as $city) {
            City::insert($city);
        }
    }
}
