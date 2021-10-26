<?php

namespace Turahe\Master\Http\Pipelines;

class Province extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->where('state_id', request($this->filterName()));
    }
}
