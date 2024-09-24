<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__.'/../../resources/data/id/cities.json';
        $data = json_decode(file_get_contents($file), true);
        $cities = array_map(function ($arr) {
            return [
                'name' => ucwords($arr['name']),
                'province_id' => $arr['province_id'],
                'code' => $arr['code'],
                'type' => $arr['type'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table(config('master.tables.cities'))->insert($cities);
    }
}
