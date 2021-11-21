<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Village;

class VillagesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__. '/../../resources/id/villages.csv';


        $header = ['id', 'district_id', 'name'];
        $data = csv_to_array($file, $header);
        $villages = array_map(function ($arr) {
            $district = District::where('code', $arr['district_id'])->firstOrFail();
            return [
                'name' => Str::title($arr['name']),
                'district_id' => $district->id,
                'code' => $arr['id'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }, $data);

        foreach (array_chunk($villages, 50) as $village) {
            Village::insert($village);
        }
    }
}
