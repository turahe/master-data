<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Turahe\Master\Models\City;
use Turahe\Master\Models\District;

class DistrictsTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/districts.csv';


        $header = ['id', 'regency_id', 'name'];
        $data = csv_to_array($file, $header);
        $districts = array_map(function ($arr) {
            $city = app('db')->table('tm_cities')->where('code', $arr['regency_id'])->first();
            return [
                'name' => Str::title($arr['name']),
                'city_id' => $city->id,
                'code' => $arr['id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table('tm_districts')->insert($districts);
    }
}
