<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Turahe\Master\Models\Timezone;

class TimeZoneTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = __DIR__.'/../../resources/timezones.json';
        $data = json_decode(file_get_contents($file), true);

        $colors = array_map(function ($color) {
            return [
                'value' => $color['value'],
                'abbr' => $color['abbr'],
                'offset' => $color['offset'],
                'isdst' => $color['isdst'],
                'text' => $color['text'],
                'utc' => $color['utc'],
                'status' => true,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);
        Timezone::insert($colors);
    }
}
