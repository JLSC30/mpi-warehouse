<?php

namespace App\Models;

use App\Models\Concerns\FiltersBySearch;
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
    use FiltersBySearch, HasFactory, SoftDeletes;

    /**
     * Scope a query using the category filters.
     *
     * @param  Builder<Location>  $query
     * @param  array<string, mixed>  $filters
     */
    #[Scope]
    protected function filter(Builder $query, array $filters): void
    {
        $this->applySearchFilter($query, $filters, ['name']);
    }
}
