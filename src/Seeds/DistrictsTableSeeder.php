<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Turahe\Master\Models\District;

class DistrictsTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/districts.csv';


        $header = ['id', 'city_id', 'name', 'lat', 'long'];
        $data = csv_to_array($file, $header);
        $districts = array_map(function ($arr) {
            return [
                'name' => Str::title($arr['name']),
                'city_id' => $arr['city_id'],
                'latitude' => $arr['lat'],
                'longitude' => $arr['long'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }, $data);

        District::insert($districts);
    }
}
