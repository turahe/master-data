<?php

namespace Turahe\Master\Models;

/**
 * Turahe\Master\Models\Currency.
 *
 * @property string                          $id
 * @property int|null                        $priority
 * @property string|null                     $iso_code
 * @property string|null                     $name
 * @property string|null                     $symbol
 * @property string|null                     $disambiguate_symbol
 * @property array|null                      $alternate_symbols
 * @property string|null                     $subunit
 * @property int                             $subunit_to_unit
 * @property int                             $symbol_first
 * @property string|null                     $html_entity
 * @property string|null                     $decimal_mark
 * @property string|null                     $thousands_separator
 * @property string|null                     $iso_numeric
 * @property int                             $smallest_denomination
 * @property string|null                     $exchange_rate         value of exchange rate from openexchange
 * @property int                             $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereAlternateSymbols($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereDecimalMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereDisambiguateSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereExchangeRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereHtmlEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIsoNumeric($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSmallestDenomination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSubunit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSubunitToUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbolFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereThousandsSeparator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    protected $table = 'tm_currencies';

    protected $casts = [
        'alternate_symbols' =>  'array',
    ];
}
