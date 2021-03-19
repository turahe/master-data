<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Currency extends Model
{
    protected $table = 'tm_currencies';

    protected $casts = [
        'alternate_symbols' =>  'array',
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * Caching model when updating and
     * delete cache when delete models
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::updating(function ($instance) {
            Cache::put('currencies.'.$instance->name, $instance);
        });
        static::deleting(function ($instance) {
            Cache::delete('currencies.'.$instance->name);
        });
    }
}
