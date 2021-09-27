<?php

namespace Turahe\Master\Test\Unit;

use Turahe\Master\Models\Color;
use Turahe\Master\Test\TestCase;

class ColorTest extends TestCase
{
    /** @test */
    public function a_color_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\ColorsTableSeeder');
        $color = Color::first();

        $this->assertEquals('AliceBlue', $color->name);
    }

    /** @test */
    public function a_color_has_logo_attribute()
    {
        $this->seed('Turahe\Master\Seeds\ColorsTableSeeder');
        $color = Color::first();

        $this->assertEquals('#F0F8FF', $color->code);
    }
}
