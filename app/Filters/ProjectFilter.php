<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProjectFilter
{
    public static function apply(Builder $query, array $filters): Builder
    {
        if (isset($filters['start_time'])) {
            $query->where('start_time', '>=', $filters['start_time']);
        }

        if (isset($filters['end_time'])) {
            $query->where('end_time', '<=', $filters['end_time']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query;
    }
}
