<?php

namespace Turahe\Master\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Turahe\Master\Contracts\Sortable;
use Turahe\Master\Traits\SortableTrait;

class Dummy extends Model implements Sortable
{
    use SortableTrait;

    protected $table = 'dummies';
    protected $guarded = [];
    public $timestamps = false;
}
