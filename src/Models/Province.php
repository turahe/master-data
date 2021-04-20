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
    public function getAddressAttribute(): string
    {
        return sprintf(
            '%s, Indonesia',
            $this->name
        );
    }
}
