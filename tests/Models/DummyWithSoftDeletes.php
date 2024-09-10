<?php

namespace Turahe\Master\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Turahe\Master\Contracts\Sortable;
use Turahe\Master\Traits\SortableTrait;

/**
 * Turahe\Master\Tests\Models\DummyWithSoftDeletes
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DummyWithSoftDeletes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DummyWithSoftDeletes newQuery()
 * @method static \Illuminate\Database\Query\Builder|DummyWithSoftDeletes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DummyWithSoftDeletes ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|DummyWithSoftDeletes query()
 * @method static \Illuminate\Database\Query\Builder|DummyWithSoftDeletes withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DummyWithSoftDeletes withoutTrashed()
 *
 * @mixin \Eloquent
 */
class DummyWithSoftDeletes extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;

    protected $table = 'dummies';

    protected $guarded = [];

    public $timestamps = false;
}
