<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class VillagesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/villages.csv';

        $header = ['id', 'district_id', 'name'];
        $data = csv_to_array($file, $header);
        $villages = array_map(function ($arr) {
            $district = app('db')->table('tm_districts')->where('code', $arr['district_id'])->first();
            return [
                'name' => ucwords($arr['name']),
                'district_id' => $district->id,
                'code' => $arr['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->disableQueryLog();

        app('db')->table('tm_villages')->insert($villages);
    }
}
