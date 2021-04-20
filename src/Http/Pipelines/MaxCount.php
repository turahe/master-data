<?php


namespace Turahe\Master\Http\Pipelines;

class MaxCount extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        return $builder->take(request($this->filterName()));
    }
}
