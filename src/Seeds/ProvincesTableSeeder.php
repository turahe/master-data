<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\Province;
use Illuminate\Support\Str;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/provinces.csv';

        $header = ['id', 'name'];
        $data = csv_to_array($file, $header);
        $provinces = array_map(function ($arr) {
            return [
                'country_id' => 104,
                'name' => Str::title($arr['name']),
                'code' => $arr['id'],
            ];
        }, $data);

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
