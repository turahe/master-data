<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\Language;

class LanguagesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/languages.json';
        $data = json_decode(file_get_contents($file), true);
        $languages = array_map(function ($arr) {
            return [
                'code' => $arr['code'],
                'name' => $arr['name'],
                'native' => $arr['native'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }, $data);

        app('db')->table('tm_languages')->insert($languages);
    }
}
