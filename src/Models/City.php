<?php
namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Scout\Searchable;

/**
 * Turahe\Master\Models\City.
 *
 * @property string                          $id
 * @property string                          $name
 * @property string|null                     $type
 * @property string|null                     $postal_code
 * @property string|null                     $latitude
 * @property string|null                     $longitude
 * @property int                             $state_id
 * @property int                             $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\District[] $districts
 * @property-read int|null $districts_count
 * @property-read \Turahe\Master\Models\State $state
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $province_id
 * @property string|null $code
 * @property-read \Turahe\Master\Models\State|null $province
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\Village[] $villages
 * @property-read int|null $villages_count
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereProvinceId($value)
 */
class City extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'tm_cities';

    /**
     * Return the city's state.
     *
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'province_id');
    }

    /**
     * Return the city's province.
     *
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(State::class, 'province_id');
    }

    /**
     * @return HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'city_id');
    }

    /**
     * @return HasManyThrough
     */
    public function villages(): HasManyThrough
    {
        return $this->hasManyThrough(Village::class, District::class);
    }

    /**
     * Get logo of city
     *
     * @return Attribute
     */
    /**
     * Get the logo's country code.
     */
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('vendor/assets/'.$this->province->country->iso_3166_2.'/cities/' . $this->code . '.png'),
        );
    }

    /**
     * @return Attribute
     */
    public function fullName(): Attribute
    {
        $this->load('province.country');

        $name =  sprintf(
            '%s, %s, %s',
            $this->name,
            $this->province->name,
            $this->province->country->name
        );

        return Attribute::get(fn() => $name);
    }
}
