<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function getTable(): string
    {
        return config('master.tables.languages');
    }
}
