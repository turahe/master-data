<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    8/11/20, 8:06 PM
 *  @name          toko
 * @author         Wachid
 * @copyright      Copyright (c) 2019-2020.
 */

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

/**
 * Turahe\Master\Color
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @method static Builder|Color newModelQuery()
 * @method static Builder|Color newQuery()
 * @method static Builder|Color query()
 * @method static Builder|Color whereCode($value)
 * @method static Builder|Color whereId($value)
 * @method static Builder|Color whereName($value)
 * @mixin \Eloquent
 */
class Color extends Model
{
    protected $table = 'tm_colors';
    /**
     * @inheritDoc
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('alphabetical', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
        static::updating(function ($instance) {
            Cache::put('colors.'.$instance->slug, $instance);
        });
        static::deleting(function ($instance) {
            Cache::delete('colors.'.$instance->slug);
        });
    }
}
