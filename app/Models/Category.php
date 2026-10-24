<?php

namespace App\Models;

use App\Policies\CategoryPolicy;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['code', 'name'])]

#[UsePolicy(CategoryPolicy::class)]
class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory, SoftDeletes;

    /**
     * Scope a query using the category filters.
     *
     * @param  array<string, mixed>  $filters
     */
    #[Scope]
    protected function filter(Builder $query, array $filters): void
    {
        $search = $filters['search'] ?? null;

        if (is_string($search) && ($search = trim($search)) !== '') {
            $query->where(function (Builder $query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        foreach (['code', 'name'] as $attribute) {
            $value = $filters[$attribute] ?? null;

            if (is_string($value) && ($value = trim($value)) !== '') {
                $query->where($attribute, 'like', "%{$value}%");
            }
        }
    }
}
