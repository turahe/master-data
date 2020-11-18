<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Turahe\Master\Models\Village;

class VillagesTableSeeder extends Seeder
{
    public function run()
    {
        $now = now()->toDateTimeString();
        $csv = new CsvtoArray();
        $resourceFiles = File::allFiles(__DIR__.'/../../resources/csv/villages');
        foreach ($resourceFiles as $file) {
            $header = ['id', 'district_id', 'name', 'lat', 'long'];
            $data = $csv->csv_to_array($file->getRealPath(), $header);

            $villages = array_map(function ($arr) use ($now) {
                return [
                    'district_id' => $arr['district_id'],
                    'name' => $arr['name'],
                    'latitude' => $arr['lat'],
                    'longitude' => $arr['long'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }, $data);

            Village::insert($villages);
        }
    }
}
