<?php
namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/regencies.csv';
        $header = ['type', 'name', 'province_id', 'id', 'code'];
        $data = csv_to_array($file, $header);
        $cities = array_map(function ($arr) {
            $type = strpos($arr['name'], 'Kabupaten') == 'Kabupaten' ? 'Kota' : 'CITY';
            $province = app('db')->table('tm_provinces')->where('code', $arr['province_id'])->first();

            return [
                'name'        => ucwords($arr['name']),
                'province_id' => $province->id,
                'code'        => $arr['code'],
                'type'        => $type,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table('tm_cities')->insert($cities);
    }
}
