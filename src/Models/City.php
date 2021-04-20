<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->belongsTo(State::class);
    }
}
