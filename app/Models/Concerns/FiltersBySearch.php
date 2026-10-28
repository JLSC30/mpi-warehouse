<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait FiltersBySearch
{
    /**
     * @param  Builder<Model>  $query
     * @param  array<string, mixed>  $filters
     *
     * @params list<string> $columns
     */
    protected function applySearchFilter(Builder $query, array $filters, array $columns): void
    {
        $search = $filters['search'] ?? null;

        if (is_string($search) && ($search = trim($search)) !== '') {
            $query->where(function (Builder $query) use ($search, $columns): void {
                foreach ($columns as $index => $column) {
                    $index === 0
                        ? $query->where($column, 'like', "%{$search}%")
                        : $query->orWhere($column, 'like', "%{$search}%");
                }
            });
        }

        foreach ($columns as $column) {
            $value = $filters[$column] ?? null;

            if (is_string($value) && ($value = trim($value)) !== '') {
                $query->where($column, 'like', "%{$value}%");
            }
        }
    }
}
