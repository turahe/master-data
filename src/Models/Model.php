<?php

namespace Turahe\Master\Models;

use Turahe\Master\Traits\AutoFilter;
use Turahe\Master\Traits\AutoSort;

/**
 * Class Model
 * @package Turahe\Master\Models
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    use AutoFilter;
    use AutoSort;
    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $searchableColumns = ['id', 'name'];

    /**
     * Model constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('turahe.indonesia.table_prefix').$this->table;
    }

    /**
     * @param $query
     * @param $keyword
     */
    public function scopeSearch($query, $keyword)
    {
        if ($keyword && $this->searchableColumns) {
            $query->whereLike($this->searchableColumns, $keyword);
        }
    }
}
