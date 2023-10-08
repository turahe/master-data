<?php
namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\District;

class DistrictsTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/districts.csv';

        $header = ['name', 1, 2, 3,  'regency_id','code' ];
        $data = csv_to_array($file, $header);

        foreach ($data as $arr)
        {
            $city = app('db')->table('tm_cities')->where('code', $arr['regency_id'])->first();
            District::create([
                'name'       => Str::title($arr['name']),
                'city_id'    => $city->id,
                'code'       => $arr['code'],
            ]);
        }
    }
}
