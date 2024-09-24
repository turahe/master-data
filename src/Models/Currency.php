<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Currency extends Model
{
    public function getTable(): string
    {
        return config('master.tables.currencies');
    }

    protected $fillable = [
        'priority',
        'iso_code',
        'name',
        'symbol',
        'disambiguate_symbol',
        'alternate_symbols',
        'subunit',
        'subunit_to_unit',
        'symbol_first',
        'html_entity',
        'decimal_mark',
        'thousands_separator',
        'iso_numeric',
        'smallest_denomination',
    ];

    protected $casts = [
        'alternate_symbols' => 'object',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'iso_code', 'currency_code');

    }
}
