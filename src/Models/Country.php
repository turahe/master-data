<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string|null $capital
 * @property string|null $citizenship
 * @property string $country_code
 * @property string|null $currency_name
 * @property string|null $currency_code
 * @property string|null $currency_sub_unit
 * @property string|null $currency_symbol
 * @property string|null $full_name
 * @property string $iso_3166_2
 * @property string $iso_3166_3
 * @property string $name
 * @property string|null $region_code
 * @property string|null $sub_region_code
 * @property bool $eea
 * @property string $calling_code
 * @property string|null $flag
 * @property string|null $latitude
 * @property string|null $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Turahe\Master\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Turahe\Master\Models\Province> $provinces
 * @property-read int|null $provinces_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Turahe\Master\Models\State> $states
 * @property-read int|null $states_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCallingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCitizenship($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCurrencySubUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCurrencySymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereEea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereIso31662($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereIso31663($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereSubRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Country extends Model
{
    protected $fillable = [
        'capital',
        'citizenship',
        'country_code',
        'currency_name',
        'currency_code',
        'currency_sub_unit',
        'currency_symbol',
        'full_name',
        'iso_3166_2',
        'iso_3166_3',
        'name',
        'region_code',
        'sub_region_code',
        'eea',
        'calling_code',
        'flag',
        'latitude',
        'longitude',

    ];

    protected function casts(): array
    {
        return [
            'eea' => 'boolean',
        ];
    }

    public function getTable(): string
    {
        return config('master.tables.countries');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'iso_code');

    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
    }

    /**
     * Get the flag's country code.
     */
    protected function flag(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('vendor/assets/countries/flags/'.$this->code.'.png'),
        );
    }
}
