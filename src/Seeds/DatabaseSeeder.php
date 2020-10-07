<?php

namespace Turahe\Master\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Turahe\Master\Models\City;
use Turahe\Master\Models\District;
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
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            VillagesSeeder::class
        ]);
    }

    public function reset()
    {
        Schema::disableForeignKeyConstraints();

        Village::truncate();
        District::truncate();
        City::truncate();
        Province::truncate();

        Schema::disableForeignKeyConstraints();
    }
}
