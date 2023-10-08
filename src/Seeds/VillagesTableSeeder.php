<?php
namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Turahe\Master\Models\Village;

class VillagesTableSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Village::truncate();
        $file = __DIR__ . '/../../resources/id/villages.csv';

        $header = ['postal_code','name', 1, 2, 3, 4, 'code', 'district_id', ];
        $data = csv_to_array($file, $header);

        foreach ($data as $value)
        {
            $district = app('db')->table('tm_districts')->where('code', $value['district_id'])->first();
            Village::create([
                'name'        => ucwords($value['name']),
                'district_id' => $district->id,
                'code'        => $value['code'],
                'postal_code' => $value['postal_code'],
            ]);
        }


    }
}
