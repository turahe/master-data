<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Turahe\Master\Models\Province.
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property string|null $region
 * @property string|null $iso_3166_2
 * @property string|null $region_code
 * @property string|null $calling_code
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\City[] $cities
 * @property-read int|null $cities_count
 * @property-read \Turahe\Master\Models\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\District[] $districts
 * @property-read int|null $districts_count
 * @property-read string $address
 *
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCallingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereIso31662($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 *
 * @property string|null $code
 *
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCode($value)
 */
class State extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'country_id',
        'name',
        'region',
        'iso_3166_2',
        'code',
        'latitude',
        'longitude',

    ];

    public function getTable(): string
    {
        return config('master.tables.provinces', 'tm_provinces');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'province_id');
    }

    public function districts(): HasManyThrough
    {
        return $this->hasManyThrough(
            District::class,
            City::class,
            'province_id',
            'city_id',
        );
    }

    /**
     * Get the logo's country code.
     */
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('vendor/assets/'.$this->country->iso_3166_2.'/provinces/'.$this->code.'.png'),
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::get(fn () => $this->name.' '.$this->code);
    }
}
