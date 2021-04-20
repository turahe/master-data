<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    /**
     * @var string
     */
    protected $table = 'tm_districts';

    protected $fillable = [
        'name',
        'city_id',
        'latitude',
        'longitude'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * @return HasMany
     */
    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'district_id');
    }

    /**
     * @return mixed
     */
    public function getCityNameAttribute()
    {
        return $this->city->name;
    }

    /**
     * @return mixed
     */
    public function getProvinceNameAttribute()
    {
        return $this->city->province->name;
    }

    /**
     * @return string
     */
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
