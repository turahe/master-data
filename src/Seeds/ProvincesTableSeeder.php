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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table('tm_provinces')->insert($provinces);
    }
}
