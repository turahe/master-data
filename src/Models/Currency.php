<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $priority
 * @property string $iso_code
 * @property string|null $name
 * @property string|null $symbol
 * @property string|null $disambiguate_symbol
 * @property object|null $alternate_symbols
 * @property string|null $subunit
 * @property int $subunit_to_unit
 * @property bool $symbol_first
 * @property string|null $html_entity
 * @property string|null $decimal_mark
 * @property string|null $thousands_separator
 * @property string|null $iso_numeric
 * @property int $smallest_denomination
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Turahe\Master\Models\Country|null $country
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereAlternateSymbols($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereDecimalMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereDisambiguateSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereHtmlEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereIsoNumeric($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereSmallestDenomination($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereSubunit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereSubunitToUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereSymbolFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereThousandsSeparator($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Currency extends Model
{
    public function getTable(): string
    {
        return config('master.tables.currencies', 'tm_currencies');
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
