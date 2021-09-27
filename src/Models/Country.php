<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Turahe\Master\Models\Country.
 *
 * @property string                          $id
 * @property string|null                     $capital
 * @property string|null                     $citizenship
 * @property string                          $country_code
 * @property string|null                     $currency
 * @property string|null                     $currency_code
 * @property string|null                     $currency_sub_unit
 * @property string|null                     $currency_symbol
 * @property string|null                     $full_name
 * @property string                          $iso_3166_2
 * @property string                          $iso_3166_3
 * @property string                          $name
 * @property string|null                     $region_code
 * @property string|null                     $sub_region_code
 * @property int                             $eea
 * @property string                          $calling_code
 * @property string|null                     $flag
 * @property int                             $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\State[] $states
 * @property-read int|null $states_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCallingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCitizenship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencySubUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencySymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereEea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso31662($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso31663($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereSubRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Country extends Model
{
    protected $table = 'tm_countries';

    /**
     * @return HasMany
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function provinces(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
