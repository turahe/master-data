<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'native',
    ];

    public function getTable(): string
    {
        return config('master.tables.languages');
    }
}
