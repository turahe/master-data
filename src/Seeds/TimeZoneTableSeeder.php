<?php

namespace Turahe\Master\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\Timezone;

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
                'value' => $color['value'],
                'abbr' => $color['abbr'],
                'offset' => $color['offset'],
                'isdst' => $color['isdst'],
                'text' => $color['text'],
                'utc' => $color['utc'],
                'status' => true,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }, $data);

        Timezone::insert($timezones);
    }
}
