<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class City extends Model
{
    protected $fillable = [
        'province_id',
        'name',
        'type',
        'code',
        'latitude',
        'longitude',

    ];

    public function getTable(): string
    {
        return config('master.tables.cities', 'tm_cities');
    }

    /**
     * Return the city's state.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'province_id');
    }

    /**
     * Return the city's province.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(State::class, 'province_id');
    }

    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'city_id');
    }

    public function villages(): HasManyThrough
    {
        return $this->hasManyThrough(Village::class, District::class);
    }

    /**
     * Get logo of city
     */
    /**
     * Get the logo's country code.
     */
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('vendor/assets/'.$this->province->country->iso_3166_2.'/cities/'.$this->code.'.png'),
        );
    }

    public function fullName(): Attribute
    {
        $this->load('province.country');

        $name = sprintf(
            '%s, %s, %s',
            $this->name,
            $this->province->name,
            $this->province->country->name
        );

        return Attribute::get(fn () => $name);
    }
}
