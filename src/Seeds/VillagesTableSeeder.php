<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Turahe\Master\Models\Village;

class VillagesTableSeeder extends Seeder
{
    public function run()
    {
        $now = now()->toDateTimeString();

        $resourceFiles = File::allFiles(__DIR__.'/../../resources/csv/villages');
        foreach ($resourceFiles as $file) {
            $header = ['id', 'district_id', 'name', 'lat', 'long'];
            $data = csv_to_array($file->getRealPath(), $header);

            $villages = array_map(function ($arr) {
                return [
                    'district_id' => $arr['district_id'],
                    'name' => $arr['name'],
                    'latitude' => $arr['lat'],
                    'longitude' => $arr['long'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
            }, $data);

            foreach (array_chunk($villages, 30) as $village) {
                Village::insert($village);
            }
        }
    }
}
