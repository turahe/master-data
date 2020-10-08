<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Turahe\Master\Models\City;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $Csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/cities.csv';
        $header = ['id', 'province_id', 'name', 'lat', 'long'];
        $data = $Csv->csv_to_array($file, $header);
        $cities = array_map(function ($arr) {

            return [
                'province_id' => $arr['province_id'],
                'name' => $arr['name'],
                'lat' => $arr['lat'],
                'long' => $arr['long'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
        }, $data);

        City::insert($cities);
    }
}
