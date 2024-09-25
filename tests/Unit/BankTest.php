<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Master\Models\Bank;
use Turahe\Master\Tests\TestCase;

class BankTest extends TestCase
{
    #[Test]
    public function a_bank_has_attribute()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();

        $this->assertEquals('Bank Mandiri', $bank->name);
        $this->assertEquals('Mandiri', $bank->alias);
        $this->assertEquals('PT Bank Mandiri (Persero) Tbk.', $bank->company);
        $this->assertEquals('008', $bank->code);
    }

    #[Test]
    public function it_can_create_the_bank()
    {
        $data = [
            'name' => 'Bank Nama',
            'alias' => 'Bank alias',
            'company' => 'PT. Bank Contoh',
            'code' => 'BM',
        ];

        $bank = Bank::create($data);

        $this->assertEquals($data['name'], $bank->name);
        $this->assertEquals($data['alias'], $bank->alias);
        $this->assertEquals($data['company'], $bank->company);
        $this->assertEquals($data['code'], $bank->code);
    }

    #[Test]
    public function it_can_delete_a_bank()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();

        $deleted = $bank->delete();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing(config('master.tables.banks'), ['name' => $bank->name]);
    }

    #[Test]
    public function it_errors_when_updating_the_bank()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();
        $this->expectException(QueryException::class);

        $bank->update(['name' => null]);
    }

    #[Test]
    public function it_can_update_the_bank()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();

        $update = ['code' => '011'];
        $bank->update($update);

        $this->assertEquals('011', $bank->code);
    }

    #[Test]
    public function it_can_find_the_bank()
    {
        $this->seed('Turahe\Master\Seeds\BanksTableSeeder');
        $bank = Bank::first();

        $found = Bank::where('code', $bank->code)->first();

        $this->assertEquals($bank->code, $found->code);
    }
}
