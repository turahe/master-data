<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Village extends Model
{
    /**
     * @var string
     */
    protected $table = 'tm_villages';

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * @return mixed
     */
    public function getDistrictNameAttribute()
    {
        return $this->district->name;
    }

    /**
     * @return mixed
     */
    public function getCityNameAttribute()
    {
        return $this->district->city->name;
    }

    /**
     * @return mixed
     */
    public function getProvinceNameAttribute()
    {
        return $this->district->city->state->name;
    }

    /**
     * @return string
     */
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
