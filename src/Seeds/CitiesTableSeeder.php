<?php

namespace Turahe\Master\Seeds;

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
                'type' => isset($arr['type']) ? $arr['type'] : null,
                'postal_code' => $arr['postal_code'],
                'latitude' => $arr['latitude'],
                'longitude' => $arr['longitude'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);

        foreach (array_chunk($cities, 30) as $city) {
            City::insert($cities);
        }
    }
}
