<?php

namespace Turahe\Address\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Village
 * @package Turahe\Address\Models
 */
class Village extends Model
{
    /**
     * @var string
     */
    protected $table = 'villages';

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

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
        return $this->district->city->province->name;
    }

    /**
     * @return string
     */
    public function getAddressAttribute()
    {
        return sprintf(
            '%s, %s, %s, %s, Indonesia',
            $this->name,
            $this->district->name,
            $this->district->city->name,
            $this->district->city->province->name
        );
    }
}
