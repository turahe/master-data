<?php

namespace Turahe\Master\Test\Feature\Http\Controllers;

use Turahe\Master\Tests\TestCase;

class BankControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $response = $this->get('/master/banks');

        $response->assertStatus(200);
    }
}
