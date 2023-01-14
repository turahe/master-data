<?php
namespace Turahe\Master\Seeds;

use Turahe\Master\Models\City;
use Illuminate\Database\Seeder;
use Turahe\Master\Models\Color;
use Turahe\Master\Models\Country;
use Turahe\Master\Models\Village;
use Turahe\Master\Models\Currency;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Province;
use Illuminate\Support\Facades\Schema;

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
            CurrenciesTableSeeder::class,
            ColorsTableSeeder::class,
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
        Color::truncate();
        Village::truncate();
        District::truncate();
        City::truncate();
        Province::truncate();
        Country::truncate();

        Schema::disableForeignKeyConstraints();
    }
}
