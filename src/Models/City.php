<?php

namespace Turahe\Address\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class City
 * @package Turahe\Address\Models
 *
 * @property int $id
 * @mixin \Eloquent
 */

class City extends Model
{
    /**
     * @var string
     */
    protected $table = 'cities';

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
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
     * @return mixed
     */
    public function getProvinceNameAttribute()
    {
        return $this->province->name;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getLogoPathAttribute()
    {
        $folder = 'indonesia-logo/';
        $id = $this->getAttributeValue('id');
        $arr_glob = glob(public_path().'/'.$folder.$id.'.*');
        if (count($arr_glob) == 1) {
            $logo_name = basename($arr_glob[0]);
            $logo_path = url($folder.$logo_name);

            return $logo_path;
        }
    }

    /**
     * @return string
     */
    public function getAddressAttribute(): string
    {
        return sprintf(
            '%s, %s, Indonesia',
            $this->name,
            $this->provinsi->name
        );
    }
}
