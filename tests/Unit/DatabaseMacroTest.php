<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Turahe\Master\Tests\TestCase;

class DatabaseMacroTest extends TestCase
{
    /**
     * Test if a database table can be created with the marco for userstamps.
     *
     * @test
     *
     * @return void
     */
    public function it_can_create_a_table_with_userstamps()
    {
        Schema::create('it_can_create_a_table_with_userstamps', function (Blueprint $table) {
            $table->increments('id');
            $table->userStamps();
        });

        $columns = Schema::getColumnlisting('it_can_create_a_table_with_userstamps');

        $this->assertContains('created_by', $columns);
        $this->assertContains('updated_by', $columns);
    }

    /**
     * Test if a database table can be created with the marco for soft userstamps.
     *
     * @test
     *
     * @return void
     */
    public function it_can_create_a_table_with_soft_userstamps()
    {
        Schema::create('it_can_create_a_table_with_soft_userstamps', function (Blueprint $table) {
            $table->increments('id');
            $table->softUserStamps();
        });

        $columns = Schema::getColumnlisting('it_can_create_a_table_with_soft_userstamps');

        $this->assertContains('deleted_by', $columns);
    }

    /**
     * Test if a database table can be created with the marco for soft userstamps.
     *
     * @test
     *
     * @return void
     */
    public function it_can_alter_a_table_for_dropping_userstamps()
    {
        Schema::create('it_can_alter_a_table_for_dropping_userstamps', function (Blueprint $table) {
            $table->increments('id');
            $table->userStamps();
        });

        $columns = Schema::getColumnlisting('it_can_alter_a_table_for_dropping_userstamps');

        $this->assertContains('created_by', $columns);
        $this->assertContains('updated_by', $columns);

        Schema::table('it_can_alter_a_table_for_dropping_userstamps', function (Blueprint $table) {
            $table->dropUserStamps();
        });

        $columns = Schema::getColumnlisting('it_can_alter_a_table_for_dropping_userstamps');

        $this->assertNotContains('created_by', $columns);
        $this->assertNotContains('updated_by', $columns);
    }

    /**
     * Test if a database table can be created with the marco for soft userstamps.
     *
     * @test
     *
     * @return void
     */
    public function it_can_alter_a_table_for_dropping_soft_user_stamps()
    {
        Schema::create('it_can_alter_a_table_for_dropping_soft_userstamps', function (Blueprint $table) {
            $table->increments('id');
            $table->softUserStamps();
        });

        $columns = Schema::getColumnlisting('it_can_alter_a_table_for_dropping_soft_userstamps');

        $this->assertContains('deleted_by', $columns);

        Schema::table('it_can_alter_a_table_for_dropping_soft_userstamps', function (Blueprint $table) {
            $table->dropSoftUserStamps();
        });

        $columns = Schema::getColumnlisting('it_can_alter_a_table_for_dropping_soft_userstamps');

        $this->assertNotContains('deleted_by', $columns);
    }
}
