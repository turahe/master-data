<?php

namespace Turahe\Master\Models;

class Currency extends Model
{
    protected $table = 'tm_currencies';

    protected $casts = [
        'alternate_symbols' =>  'array',
    ];
}
