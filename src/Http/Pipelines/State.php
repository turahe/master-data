<?php


namespace Turahe\Master\Http\Pipelines;

class State extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->where('state_id', request($this->filterName()));
    }
}
