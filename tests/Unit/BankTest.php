<?php
namespace Turahe\Master\Tests\Unit;

use Turahe\Master\Models\Bank;
use Turahe\Master\Tests\TestCase;

class BankTest extends TestCase
{
    /** @test */
    public function a_bank_has_name_attribute()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();

        $this->assertEquals('Bank Mandiri', $bank->name);
    }

    /** @test */
    public function a_bank_has_alias_attribute()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();

        $this->assertEquals('Mandiri', $bank->alias);
    }

    /** @test */
    public function a_bank_has_company_attribute()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();

        $this->assertEquals('PT Bank Mandiri (Persero) Tbk.', $bank->company);
    }

    /** @test */
    public function a_bank_has_code_attribute()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();

        $this->assertEquals('008', $bank->code);
    }
}
