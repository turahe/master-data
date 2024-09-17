<?php

namespace Turahe\Master\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Turahe\Master\Tests\Models\Dummy
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Dummy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dummy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dummy ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Dummy query()
 *
 * @mixin \Eloquent
 */
class Dummy extends Model implements Sortable
{
    use SortableTrait;

    protected $table = 'dummies';

    protected $guarded = [];

    public $timestamps = false;

    public $sortable = [
        'order_column_name' => 'record_ordering',
        'sort_when_creating' => true,
    ];
}
