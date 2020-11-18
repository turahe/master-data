<?php

namespace Turahe\Master\Models;

use Turahe\Master\Traits\AutoFilter;
use Turahe\Master\Traits\AutoSort;
use Illuminate\Database\Eloquent\Model as BaseModel;
/**
 * Class Model.
 */
abstract class Model extends BaseModel
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
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
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
