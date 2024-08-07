<?php
namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get all of the currencies
        $file = __DIR__ . '/../../resources/data/currencies.json';

        $data = json_decode(file_get_contents($file), true);
        $currencies = array_map(function ($currency) {
            return [
                'priority'              => $currency['priority'] ?? 100,
                'iso_code'              => $currency['iso_code'] ?? null,
                'name'                  => $currency['name'] ?? null,
                'symbol'                => $currency['symbol'] ?? null,
                'disambiguate_symbol'   => $currency['disambiguate_symbol'] ?? null,
                'alternate_symbols'     => isset($currency['alternate_symbols']) ? json_encode($currency['alternate_symbols'], true) : null,
                'subunit'               => $currency['subunit'] ?? null,
                'subunit_to_unit'       => $currency['subunit_to_unit'] ?? 100,
                'symbol_first'          => $currency['symbol_first'] ?? 1,
                'html_entity'           => $currency['html_entity'] ?? null,
                'decimal_mark'          => $currency['decimal_mark'] ?? '.',
                'thousands_separator'   => $currency['thousands_separator'] ?? ',',
                'iso_numeric'           => $currency['iso_numeric'] ?? null,
                'smallest_denomination' => $currency['smallest_denomination'] ?? 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ];
        }, $data);

        app('db')->disableQueryLog();
        app('db')->table('tm_currencies')->insert($currencies);
    }
}
