<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DistrictsTableSeeder extends Seeder
{
    public function run()
    {

        $file = __DIR__.'/../../resources/data/id/districts.json';
        $data = json_decode(file_get_contents($file), true);
        $districts = array_map(function ($arr) {
            return [
                'name' => Str::title($arr['name']),
                'city_id' => $arr['city_id'],
                'code' => $arr['code'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table('tm_districts')->insert($districts);
    }
}
