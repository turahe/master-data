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
        Schema::create(config('master.tables.districts'), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Turahe\Master\Models\City::class, 'city_id');
            $table->string('name', 255);
            $table->string('code', 10)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
        Schema::table('tm_districts', function (Blueprint $table) {
            $table->foreign('city_id')
                ->references('id')->on('tm_cities')
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
        Schema::dropIfExists(config('master.tables.districts'));
    }
};
