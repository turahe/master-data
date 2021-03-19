<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Color extends Model
{
    protected $table = 'tm_colors';

    /**
     * {@inheritdoc}
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('alphabetical', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
        static::updating(function ($instance) {
            Cache::put('colors.'.$instance->name, $instance);
        });
        static::deleting(function ($instance) {
            Cache::delete('colors.'.$instance->name);
        });
    }
}
