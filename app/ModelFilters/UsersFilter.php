<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait UsersFilter
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
            return $builder->orderBy('name');
        } else if ($value == 'za') {
            return $builder->orderByDesc('name');
        } else if ($value == 'daz') {
            return $builder->orderBy('created_at');
        } else if ($value == 'dza') {
            return $builder->orderByDesc('created_at');
        } else {
            return $builder->orderBy('name');
        }
    }

    public function count_document(Builder $builder, $value)
    {
        $count_documents = $builder->withCount('documents')->get();

        $authors_id = [];
        foreach ($count_documents as $count_document) {
            if ($value == 1) {
                if ($count_document->documents_count >= 0 && $count_document->documents_count <= 20) {
                    $authors_id[] = $count_document->id;
                }
            } else if ($value == 2) {
                if ($count_document->documents_count >= 20 && $count_document->documents_count <= 50) {
                    $authors_id[] = $count_document->id;
                }
            } else if ($value == 3) {
                if ($count_document->documents_count >= 50 && $count_document->documents_count <= 100) {
                    $authors_id[] = $count_document->id;
                }
            } else if ($value == 4) {
                if ($count_document->documents_count >= 100) {
                    $authors_id[] = $count_document->id;
                }
            }

        }
        return $builder->whereIn('id', $authors_id);
    }
}
