<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\City;
use Turahe\Master\Models\Province;
use Illuminate\Support\Str;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/regencies.csv';
        $header = ['id', 'province_id', 'name'];
        $data = csv_to_array($file, $header);
        $cities = array_map(function ($arr) {
            $type = strpos($arr['name'], 'KAB') == 'KAB' ? 'REGENCY' : 'CITY';
            $province = Province::where('code', $arr['province_id'])->firstOrFail();
            return [
                'name' => Str::title($arr['name']),
                'province_id' => $province->id,
                'code' => $arr['id'],
                'type' => $type,
            ];
        }, $data);

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
