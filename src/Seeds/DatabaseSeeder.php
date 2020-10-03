<?php

namespace Turahe\Address\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Turahe\Address\Models\City;
use Turahe\Address\Models\District;
use Turahe\Address\Models\Province;
use Turahe\Address\Models\Village;

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

        $this->call(ProvincesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(DistrictsSeeder::class);
        $this->call(VillagesSeeder::class);
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
