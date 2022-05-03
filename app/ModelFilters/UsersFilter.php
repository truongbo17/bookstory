<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait UsersFilter
{
    /**
     * This is a sample custom query
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort(Builder $builder, $value)
    {
        if ($value == 'az') {
            return $builder->orderBy('name');
        } else if ($value == 'za') {
            return $builder->orderByDesc('name');
        } else if ($value == 'daz') {
            return $builder->orderBy('created_at');
        } else if ($value == 'dza') {
            return $builder->orderByDesc('created_at');
        }else{
            return $builder->orderBy('name');
        }
    }
}
