<?php
namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__ . '/../../resources/data/languages.json';
        $data = json_decode(file_get_contents($file), true);
        $languages = array_map(function ($arr) {
            return [
                'code'       => $arr['code'],
                'name'       => $arr['name'],
                'native'     => $arr['native'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table('tm_languages')->insert($languages);
    }
}
