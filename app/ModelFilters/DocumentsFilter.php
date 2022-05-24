<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait DocumentsFilter
{
    /**
     * This is a sample custom query
     * @param Builder $builder
     * @param                                       $value
     *
     * @return Builder
     */
    public function sort(Builder $builder, $value)
    {
        if ($value == 'az') {
            return $builder->orderBy('title');
        } else if ($value == 'za') {
            return $builder->orderByDesc('title');
        } else if ($value == 'daz') {
            return $builder->orderBy('created_at');
        } else if ($value == 'dza') {
            return $builder->orderByDesc('created_at');
        } else {
            return $builder->orderBy('title');
        }
    }

    public function count_page(Builder $builder, $value)
    {
        if ($value == 1) {
            return $builder->whereBetween('count_page', [0, 100]);
        } else if ($value == 2) {
            return $builder->whereBetween('count_page', [100, 200]);
        } else if ($value == 3) {
            return $builder->whereBetween('count_page', [200, 500]);
        } else if ($value == 4) {
            return $builder->where('count_page', '>', 500);
        } else {
            return $builder->where('count_page', '>', 0);
        }
    }

    public function author(Builder $builder, $value)
    {
        return $builder->with(['users' => function ($query) use ($value) {
            $query->where('name', '=', $value);
        }]);
    }

}
