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
        Schema::create('tm_villages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Turahe\Master\Models\Village::class, 'district_id')->nullable();
            $table->string('name', 255);
            $table->string('code', 10)->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
        Schema::table('tm_villages', function (Blueprint $table) {
            $table->foreign('district_id')
                ->references('id')->on('tm_districts')
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
        Schema::dropIfExists('tm_villages');
    }
};
