<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Turahe\Master\Models\Bank;
use Turahe\Master\Models\City;
use Turahe\Master\Models\Country;
use Turahe\Master\Models\Currency;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Language;
use Turahe\Master\Models\Province;
use Turahe\Master\Models\Village;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->reset();

        $this->call([
            CountriesTableSeeder::class,
            ProvincesTableSeeder::class,
            CitiesTableSeeder::class,
            DistrictsTableSeeder::class,
            VillagesTableSeeder::class,
            LanguagesTableSeeder::class,
            CurrenciesTableSeeder::class,
            BanksTableSeeder::class,
        ]);
    }

    /**
     * Reset database with disable foreign key and enable again
     * if database was truncate.
     */
    public function reset()
    {
        Schema::disableForeignKeyConstraints();

        Currency::truncate();
        Village::truncate();
        District::truncate();
        City::truncate();
        Province::truncate();
        Country::truncate();
        Language::truncate();
        Bank::truncate();

        Schema::disableForeignKeyConstraints();
    }
}
