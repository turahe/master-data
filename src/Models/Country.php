<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'capital',
        'citizenship',
        'country_code',
        'currency_name',
        'currency_code',
        'currency_sub_unit',
        'currency_symbol',
        'full_name',
        'iso_3166_2',
        'iso_3166_3',
        'name',
        'region_code',
        'sub_region_code',
        'eea',
        'calling_code',
        'flag',
        'latitude',
        'longitude',

    ];

    protected function casts(): array
    {
        return [
            'eea' => 'boolean',
        ];
    }

    public function getTable(): string
    {
        return config('master.tables.countries');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'iso_code');

    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
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
