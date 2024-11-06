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
        Schema::create(config('master.tables.banks', 'tm_banks'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->string('company');
            $table->string('code')->index();
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
        Schema::dropIfExists(config('master.tables.banks', 'tm_banks'));
    }
};
