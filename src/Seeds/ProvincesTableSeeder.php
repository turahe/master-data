<?php
namespace Turahe\Master\Seeds;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\Province;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/data/id/provinces.json';
        $data = json_decode(file_get_contents($file), true);
        $provinces = array_map(function ($arr) {
            return [
                'country_id' => 104,
                'name'       => Str::title($arr['name']),
                'code'       => $arr['code'],
            ];
        }, $data);
        
        foreach ($data as $arr)
        {
            Province::create([
                'country_id' => 104,
                'name'       => Str::title($arr['name']),
                'code'       => $arr['code'],
            ]);
        }

    }
}
