<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = __DIR__.'/../../resources/data/countries.json';
        $data = json_decode(file_get_contents($file), true);
        $countries = array_map(function ($country) {
            return [
                'capital' => $country['capital'] ?? null,
                'citizenship' => ((isset($country['citizenship'])) ? $country['citizenship'] : null),
                'country_code' => $country['country_code'],
                'currency' => ((isset($country['currency'])) ? $country['currency'] : null),
                'currency_code' => ((isset($country['currency_code'])) ? $country['currency_code'] : null),
                'currency_sub_unit' => ((isset($country['currency_sub_unit'])) ? $country['currency_sub_unit'] : null),
                'full_name' => ((isset($country['full_name'])) ? $country['full_name'] : null),
                'iso_3166_2' => $country['iso_3166_2'],
                'iso_3166_3' => $country['iso_3166_3'],
                'name' => $country['name'],
                'region_code' => (isset($country['region_code'])) ? $country['region_code'] : null, //$country['region_code'],
                'sub_region_code' => (isset($country['sub_region_code'])) ? $country['sub_region_code'] : null, //$country['sub_region_code'],
                'eea' => (bool) $country['eea'],
                'calling_code' => $country['calling_code'],
                'currency_symbol' => ((isset($country['currency_symbol'])) ? $country['currency_symbol'] : null),
                'flag' => ((isset($country['flag'])) ? $country['flag'] : null),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table('tm_countries')->insert($countries);
    }
}
