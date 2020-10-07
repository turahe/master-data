<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Turahe\Master\Models\City;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $Csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/cities.csv';
        $header = ['id', 'province_id', 'name', 'lat', 'long'];
        $data = $Csv->csv_to_array($file, $header);
        $cities = array_map(function ($arr) use ($now) {

            return $arr + [
                    'province_id' => $arr['province_id'],
                    'name' => $arr['name'],
                    'lat' => $arr['lat'],
                    'long' => $arr['long'],
                    'created_at' => $now,
                    'updated_at' => $now
                ];
        }, $data);

        City::insert($cities);
    }
}
