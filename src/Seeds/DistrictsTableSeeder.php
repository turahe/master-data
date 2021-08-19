<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\District;

class DistrictsTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__.'/../../resources/csv/districts.csv';
        $header = ['id', 'city_id', 'name', 'lat', 'long'];
        $data = csv_to_array($file, $header);
        $districts = array_map(function ($arr) {
            return [
                'name' => $arr['name'],
                'city_id' => $arr['city_id'],
                'latitude' => $arr['lat'],
                'longitude' => $arr['long'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }, $data);

        foreach (array_chunk($districts, 30) as $district) {
            District::insert($district);
        }
    }
}
