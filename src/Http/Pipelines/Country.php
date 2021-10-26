<?php

namespace Turahe\Master\Http\Pipelines;

class Country extends Filter
{

    protected function applyFilters($builder)
    {
        return $builder->where('country_id', request($this->filterName()));
    }
}