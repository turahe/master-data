<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = 'tm_countries';

    /**
     * @return HasMany
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
