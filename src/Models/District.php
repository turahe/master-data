<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Turahe\Master\Models\District.
 *
 * @property string $id
 * @property int $city_id
 * @property string $name
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Turahe\Master\Models\City $city
 * @property-read string $address
 * @property-read mixed $city_name
 * @property-read mixed $province_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\Village[] $villages
 * @property-read int|null $villages_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 *
 * @property string|null $code
 *
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCode($value)
 *
 * @mixin \Eloquent
 */
class District extends Model
{
    public function getTable(): string
    {
        return config('master.tables.districts');
    }

    protected $fillable = [
        'name',
        'city_id',
        'code',
        'latitude',
        'longitude',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'district_id');
    }

    public function getCityNameAttribute(): string
    {
        return $this->city->name;
    }

    public function getProvinceNameAttribute(): string
    {
        return $this->city->province->name;
    }

    public function getAddressAttribute(): string
    {
        return sprintf(
            '%s, %s, %s, Indonesia',
            $this->name,
            $this->city->name,
            $this->city->province->name
        );
    }
}
