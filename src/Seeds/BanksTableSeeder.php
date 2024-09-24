<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__.'/../../resources/data/banks.json';
        $data = json_decode(file_get_contents($file), true);
        $banks = array_map(function ($arr) {
            return [
                'name' => $arr['name'],
                'alias' => $arr['alias'],
                'company' => $arr['company'],
                'code' => $arr['code'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->table(config('master.tables.banks'))->insert($banks);
    }
}
