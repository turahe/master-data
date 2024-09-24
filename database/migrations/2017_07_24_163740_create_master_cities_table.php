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
        Schema::create(config('master.tables.cities'), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Turahe\Master\Models\Province::class, 'province_id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('code', 10)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->timestamps();
        });

        Schema::table('tm_cities', function (Blueprint $table) {
            $table->foreign('province_id')
                ->references('id')->on('tm_provinces')
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
        Schema::dropIfExists(config('master.tables.cities'));
    }
};
