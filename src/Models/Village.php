<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Turahe\Master\Models\Village.
 *
 * @property string $id
 * @property int $district_id
 * @property string $name
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Turahe\Master\Models\District $district
 * @property-read string $address
 * @property-read mixed $city_name
 * @property-read mixed $district_name
 * @property-read mixed $province_name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|Village newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Village newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Village query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 *
 * @property string|null $code
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereCode($value)
 */
class Village extends Model
{
    public function getTable(): string
    {
        return config('master.tables.villages');
    }

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function getDistrictNameAttribute(): string
    {
        return $this->district->name;
    }

    public function getCityNameAttribute(): string
    {
        return $this->district->city->name;
    }

    public function getProvinceNameAttribute(): string
    {
        return $this->district->city->state->name;
    }

    public function getAddressAttribute(): string
    {
        return sprintf(
            '%s, %s, %s, %s, Indonesia',
            $this->name,
            $this->district->name,
            $this->district->city->name,
            $this->district->city->state->name
        );
    }
}
