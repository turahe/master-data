<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Turahe\Master\Models\City;
use Turahe\Master\Models\Province;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/regencies.csv';

        $header = ['id', 'province_id', 'name'];
        $data = csv_to_array($file, $header);
        $cities = array_map(function ($arr) {
            $type = strpos($arr['name'], 'KAB') == 'KAB' ? 'REGENCIES' : 'CITY';
            $province = Province::where('code', $arr['province_id'])->first();
            return [
                'name' => Str::title($arr['name']),
                'province_id' => $province->id,
                'code' => $arr['id'],
                'type' => $type,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }, $data);

        \Schema::disableForeignKeyConstraints();
        City::truncate();
        City::insert($cities);
    }
}
