<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
        return $this->hasManyThrough(District::class, City::class);
    }

    /**
     * @return string
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
            '%s, Indonesia',
            $this->name
        );
    }
}
