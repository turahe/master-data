<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('master.tables.provinces', 'tm_provinces'), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Turahe\Master\Models\Country::class, 'country_id');
            $table->string('name', 255);
            $table->string('region', 255)->nullable();
            $table->string('iso_3166_2', 2)->nullable();
            $table->string('code', 10)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('master.tables.provinces', 'tm_provinces'));
    }
};
