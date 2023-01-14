<?php
namespace Turahe\Master\Tests\Models;

use Turahe\Master\Contracts\Sortable;
use Illuminate\Database\Eloquent\Model;
use Turahe\Master\Traits\SortableTrait;

/**
 * Turahe\Master\Tests\Models\Dummy
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Dummy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dummy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dummy ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Dummy query()
 * @mixin \Eloquent
 */
class Dummy extends Model implements Sortable
{
    use SortableTrait;

    protected $table = 'dummies';
    protected $guarded = [];
    public $timestamps = false;
}
