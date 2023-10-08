<?php
namespace Turahe\Master\Seeds;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\Province;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/id/provinces.csv';

        $header = [ 'name', 'code'];
        $data = csv_to_array($file, $header);
        $provinces = array_map(function ($arr) {
            return [
                'country_id' => 104,
                'name'       => Str::title($arr['name']),
                'code'       => $arr['code'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
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
