<?php
namespace Turahe\Master\Tests\Unit;

use Turahe\Master\Tests\TestCase;
use Turahe\Master\Models\Timezone;

class TimezoneTest extends TestCase
{
    /** @test */
    public function a_timezone_has_value_attribute()
    {
        $this->seed('Turahe\Master\Seeds\TimeZoneTableSeeder');
        $timezone = Timezone::first();

        $this->assertEquals('Dateline Standard Time', $timezone->value);
    }

    /** @test */
    public function a_timezone_has_abbr_attribute()
    {
        $this->seed('Turahe\Master\Seeds\TimeZoneTableSeeder');
        $timezone = Timezone::first();

        $this->assertEquals('DST', $timezone->abbr);
    }

    /** @test */
    public function a_timezone_has_offset_attribute()
    {
        $this->seed('Turahe\Master\Seeds\TimeZoneTableSeeder');
        $timezone = Timezone::first();

        $this->assertEquals('-12', $timezone->offset);
    }

    /** @test */
    public function a_timezone_has_isdst_attribute()
    {
        $this->seed('Turahe\Master\Seeds\TimeZoneTableSeeder');
        $timezone = Timezone::first();

        $this->assertEquals('0', $timezone->isdst);
    }

    /** @test */
    public function a_timezone_has_text_attribute()
    {
        $this->seed('Turahe\Master\Seeds\TimeZoneTableSeeder');
        $timezone = Timezone::first();

        $this->assertEquals('(UTC-12:00) International Date Line West', $timezone->text);
    }

    /** @test */
    public function a_timezone_has_utc_attribute()
    {
        $this->seed('Turahe\Master\Seeds\TimeZoneTableSeeder');
        $timezone = Timezone::first();

        $this->assertEquals('Etc/GMT+12', $timezone->utc);
    }
}
