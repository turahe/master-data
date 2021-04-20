<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * @return HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'city_id');
    }
}
