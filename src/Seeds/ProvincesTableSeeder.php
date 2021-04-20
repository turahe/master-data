<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Turahe\Master\Models\State;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__.'/../../resources/states.json';

        $data = json_decode(file_get_contents($file), true);
        $provinces = array_map(function ($province) {
            return [
                'country_id' => 104,
                'name' => $province['name'],
                'region' => $province['region'],
                'iso_3166_2' => $province['iso_3166_2'],
                'region_code' => $province['region_code'],
                'calling_code' => $province['calling_code'],
                'latitude' => $province['latitude'],
                'longitude' => $province['longitude'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $data);

        State::insert($provinces);
    }
}
