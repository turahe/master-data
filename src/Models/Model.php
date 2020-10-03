<?php

namespace Turahe\Address\Models;

use Turahe\Address\Traits\AutoFilter;
use Turahe\Address\Traits\AutoSort;

/**
 * Class Model
 * @package Turahe\Address\Models
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
