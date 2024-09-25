<?php

namespace Turahe\Master\Tests\Unit;

use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Master\Models\Language;
use Turahe\Master\Tests\TestCase;

class LanguageTest extends TestCase
{
    #[Test]
    public function a_bank_has_attribute()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $language = Language::first();

        $this->assertEquals('aa', $language->code);
        $this->assertEquals('Afar', $language->name);
        $this->assertEquals('Afar', $language->native);
    }

    #[Test]
    public function it_can_create_the_language()
    {
        $data = [
            'native' => 'Language',
            'name' => 'Language name',
            'code' => 'LM',
        ];

        $language = Language::create($data);

        $this->assertEquals($data['name'], $language->name);
        $this->assertEquals($data['native'], $language->native);
        $this->assertEquals($data['code'], $language->code);
    }

    #[Test]
    public function it_can_delete_a_language()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $language = Language::first();

        $deleted = $language->delete();

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing(config('master.tables.languages'), ['name' => $language->name]);
    }

    #[Test]
    public function it_errors_when_updating_the_language()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $language = Language::first();
        $this->expectException(QueryException::class);

        $language->update(['name' => null]);
    }

    #[Test]
    public function it_can_update_the_language()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $language = Language::first();

        $update = ['code' => 'AFF'];
        $language->update($update);

        $this->assertEquals('AFF', $language->code);
    }

    #[Test]
    public function it_can_find_the_language()
    {
        $this->seed('Turahe\Master\Seeds\LanguagesTableSeeder');
        $language = Language::first();

        $found = Language::where('code', $language->code)->first();

        $this->assertEquals($language->code, $found->code);
    }
}
