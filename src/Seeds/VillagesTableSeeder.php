<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class VillagesTableSeeder extends Seeder
{
    public function run()
    {
        app('db')->table('tm_villages')->truncate();
        $file = __DIR__.'/../../resources/data/id/villages.json';
        $data = json_decode(file_get_contents($file), true);
        app('db')->disableQueryLog();

        foreach ($data as $arr) {
            $arr['created_at'] = date('Y-m-d H:i:s');
            $arr['updated_at'] = date('Y-m-d H:i:s');
            app('db')->table('tm_villages')->insert($arr);
        }

    }
}
