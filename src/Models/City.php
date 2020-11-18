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

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

/**
 * Turahe\Master\City.
 *
 * @property int                             $id
 * @property string                          $name
 * @property null|string                     $postal_code
 * @property null|string                     $latitude
 * @property null|string                     $longitude
 * @property int                             $state_id
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property-read \Turahe\Master\Models\State $state
 *
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    /**
     * @inheritdoc
     */
    protected $table = 'tm_cities';

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
            Cache::put('cities.'.$instance->slug, $instance);
        });
        static::deleting(function ($instance) {
            Cache::delete('cities.'.$instance->slug);
        });
    }

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
