<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\Province;

class ProvincesSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/provinces.csv';
        $header = ['id', 'name', 'lat', 'long'];
        $data = $csv->csv_to_array($file, $header);
        $provinces = array_map(function ($arr) use ($now) {

            return [
                'country_id' => 104,
                'name' => $arr['name'],
                'lat' => $arr['lat'],
                'long' => $arr['long'],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }, $data);

        Province::insert($provinces);
    }
}
