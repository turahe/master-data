<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    8/11/20, 8:06 PM
 *  @name          toko
 * @author         Wachid
 * @copyright      Copyright (c) 2019-2020.
 */

namespace Turahe\Master\Models;

use Illuminate\Support\Facades\Cache;

/**
 * Turahe\Master\Currency
 *
 * @property int $id
 * @property int|null $priority
 * @property string|null $iso_code
 * @property string|null $name
 * @property string|null $symbol
 * @property string|null $disambiguate_symbol
 * @property string|null $alternate_symbols
 * @property string|null $subunit
 * @property int $subunit_to_unit
 * @property int $symbol_first
 * @property string|null $html_entity
 * @property string|null $decimal_mark
 * @property string|null $thousands_separator
 * @property string|null $iso_numeric
 * @property int $smallest_denomination
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereAlternateSymbols($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereDecimalMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereDisambiguateSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereHtmlEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereIsoNumeric($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSmallestDenomination($value)
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
    /**
     * Bootstrap the model and its traits.
     *
     * Caching model when updating and
     * delete cache when delete models
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::updating(function ($instance) {
            Cache::put('currencies.'.$instance->slug, $instance);
        });
        static::deleting(function ($instance) {
            Cache::delete('currencies.'.$instance->slug);
        });
    }
}
