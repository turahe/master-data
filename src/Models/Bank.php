<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name',
        'alias',
        'company',
        'code',
    ];

    public function getTable(): string
    {
        return config('master.tables.banks');
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
            get: fn () => asset('vendor/assets/banks/'.$this->code.'.png'),
        );
    }
}
