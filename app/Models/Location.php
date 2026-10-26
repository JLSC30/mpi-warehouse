<?php

namespace App\Models;

use Database\Factories\LocationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name'])]
class Location extends Model
{
    /** @use HasFactory<LocationFactory> */
    use HasFactory, SoftDeletes;

    /**
     * Scope a query using the category filters.
     *
     * @param  Builder<Location>  $query
     * @param  array<string, mixed>  $filters
     */
    #[Scope]
    protected function filter(Builder $query, array $filters): void
    {
        $search = $filters['search'] ?? null;

        if (is_string($search) && ($search = trim($search)) !== '') {
            $query->where(function (Builder $query) use ($search): void {
                $query->where('name', 'like', "%{$search}%");
            });
        }

        foreach (['name'] as $attribute) {
            $value = $filters[$attribute] ?? null;

            if (is_string($value) && ($value = trim($value)) !== '') {
                $query->where($attribute, 'like', "%{$value}%");
            }
        }
    }
}
