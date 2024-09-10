<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    public function getTable(): string
    {
        return config('master.tables.countries');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code');

    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function provinces(): HasMany
    {
        return $this->hasMany(State::class);
    }

    /**
     * Get the flag's country code.
     */
    protected function flag(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('vendor/assets/countries/flags/'.$this->code.'.png'),
        );
    }
}
