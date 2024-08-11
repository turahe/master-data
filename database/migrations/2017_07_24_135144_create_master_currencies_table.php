<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('priority')->nullable()->default(100);
            $table->string('iso_code', 16)->unique()->index()->primary();
            $table->string('name', 255)->nullable();
            $table->string('symbol', 255)->nullable();
            $table->string('disambiguate_symbol', 255)->nullable();
            $table->string('alternate_symbols', 255)->nullable();
            $table->string('subunit', 255)->nullable();
            $table->integer('subunit_to_unit')->default(100);
            $table->boolean('symbol_first')->default(1);
            $table->string('html_entity', 255)->nullable();
            $table->string('decimal_mark', 25)->nullable();
            $table->string('thousands_separator', 25)->nullable();
            $table->string('iso_numeric', 25)->nullable();
            $table->integer('smallest_denomination')->default(1);
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
        Schema::dropIfExists('tm_currencies');
    }
};
