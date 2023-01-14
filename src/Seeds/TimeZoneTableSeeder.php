<?php
namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class TimeZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = __DIR__ . '/../../resources/timezones.json';
        $data = json_decode(file_get_contents($file), true);

        $timezones = array_map(function ($color) {
            return [
                'value'      => $color['value'],
                'abbr'       => $color['abbr'],
                'offset'     => $color['offset'],
                'isdst'      => $color['isdst'],
                'text'       => $color['text'],
                'utc'        => $color['utc'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table('tm_timezones')->insert($timezones);
    }
}
