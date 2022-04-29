<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait DocumentsFilter
{
    /**
     * This is a sample custom query
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function s_like(Builder $builder, $value)
    {
        return $builder->where('status', '=', 0);
    }
}
