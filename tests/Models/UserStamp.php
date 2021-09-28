<?php

namespace Turahe\Master\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Turahe\Master\Traits\HasUserStamps;

class UserStamp extends Model
{
    use HasUserStamps, SoftDeletes;

    protected $table  = 'userstamps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


}