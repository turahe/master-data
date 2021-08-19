<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Turahe\Master\Models\Bank;

class BanksTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__.'/../../resources/banks.json';
        $data = json_decode(file_get_contents($file), true);
        $banks = array_map(function ($arr) {
            return [
                'name' => $arr['name'],
                'alias' => $arr['alias'],
                'company' => $arr['company'],
                'code' => $arr['code'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);

        foreach (array_chunk($banks, 30) as $bank) {
            Bank::insert($bank);
        }
    }
}
