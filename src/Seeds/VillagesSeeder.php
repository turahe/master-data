<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Turahe\Master\Models\Village;

class VillagesSeeder extends Seeder
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
                    'name' => $arr['name'],
                    'lat' => $arr['lat'],
                    'long' => $arr['long'],
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }, $data);

            Village::insert($villages);
        }
    }
}
