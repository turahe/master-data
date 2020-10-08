<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Turahe\Master\Models\District;

class DistrictsSeeder extends Seeder
{
    public function run()
    {
        $now = now()->toDateTimeString();
        $csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/districts.csv';
        $header = ['id', 'city_id', 'name', 'lat', 'long'];
        $data = $csv->csv_to_array($file, $header);
        $districts = array_map(function ($arr) use ($now) {

            return [
                'name' => $arr['name'],
                'city_id' => $arr['city_id'],
                'lat' => $arr['lat'],
                'long' => $arr['long'],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }, $data);

        District::insert($districts);

    }
}
