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
        Schema::create('tm_timezones', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable();
            $table->string('abbr')->nullable();
            $table->integer('offset')->nullable();
            $table->boolean('isdst')->nullable();
            $table->string('text')->nullable();
            $table->string('utc')->nullable();
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
        Schema::dropIfExists('tm_timezones');
    }
};
