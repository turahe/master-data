<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        $file = __DIR__.'/../../resources/data/id/provinces.json';
        $data = json_decode(file_get_contents($file), true);

        $country = app('db')->table(config('master.tables.countries'))->where('iso_3166_2', 'ID')->first();
        if (is_null($country)) {
            throw new \Exception('Country not found');
        }

        $provinces = array_map(function ($arr) use ($country) {
            return [
                'country_id' => $country->id,
                'name' => Str::title($arr['name']),
                'code' => $arr['code'],
                'latitude' => $arr['latitude'],
                'longitude' => $arr['longitude'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);

        app('db')->table(config('master.tables.provinces'))->insert($provinces);

    }
}
