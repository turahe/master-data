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
        Schema::create(config('master.tables.countries', 'tm_countries'), function (Blueprint $table) {
            $table->id();
            $table->string('capital', 255)->nullable();
            $table->string('citizenship', 255)->nullable();
            $table->string('country_code', 3)->index();
            $table->string('currency_name', 255)->nullable();
            $table->string('currency_code', 255)->index()->nullable();
            $table->string('currency_sub_unit', 255)->nullable();
            $table->string('currency_symbol', 3)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('iso_3166_2', 2)->index();
            $table->string('iso_3166_3', 3)->index();
            $table->string('name', 255);
            $table->string('region_code', 3)->nullable();
            $table->string('sub_region_code', 3)->nullable();
            $table->boolean('eea');
            $table->string('calling_code', 3)->index();
            $table->string('flag', 6)->nullable();
            $table->string('latitude')->index()->nullable();
            $table->string('longitude')->index()->nullable();
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
        Schema::dropIfExists(config('master.tables.countries', 'tm_countries'));
    }
};
