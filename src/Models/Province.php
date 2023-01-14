<?php
namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Turahe\Master\Models\Province.
 *
 * @property int                             $id
 * @property int                             $country_id
 * @property string                          $name
 * @property string|null                     $region
 * @property string|null                     $iso_3166_2
 * @property string|null                     $region_code
 * @property string|null                     $calling_code
 * @property string|null                     $latitude
 * @property string|null                     $longitude
 * @property int                             $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\City[] $cities
 * @property-read int|null $cities_count
 * @property-read \Turahe\Master\Models\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\District[] $districts
 * @property-read int|null $districts_count
 * @property-read string $address
 * @method static \Illuminate\Database\Eloquent\Builder|Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province query()
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCallingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereIso31662($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $code
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCode($value)
 */
class Province extends State
{
    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'state_id');
    }

    /**
     * @return HasManyThrough
     */
    public function districts(): HasManyThrough
    {
        return $this->hasManyThrough(District::class, City::class, 'state_id', 'city_id');
    }

    /**
     * @return string
     */
    public function getAddressAttribute(): string
    {
        return sprintf(
            '%s, Indonesia',
            $this->name
        );
    }
}
