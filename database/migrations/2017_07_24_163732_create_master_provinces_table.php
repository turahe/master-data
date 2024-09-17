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
        Schema::create('tm_provinces', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Turahe\Master\Models\Country::class, 'country_id')->nullable();
            $table->string('name', 255);
            $table->string('region', 255)->nullable();
            $table->string('iso_3166_2', 2)->nullable();
            $table->string('code', 10)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });

        Schema::table('tm_provinces', function (Blueprint $table) {
            $table->foreign('country_id')
                ->references('id')->on('tm_countries')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_provinces');
    }
};
