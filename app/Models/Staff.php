<?php

namespace App\Models;

use Database\Factories\StaffFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'is_active', 'user_id'])]
class Staff extends Model
{
    /** @use HasFactory<StaffFactory> */
    use HasFactory, SoftDeletes;

    /**
     * Get the user assigned to the staff member.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query using the staff filters.
     *
     * @param  Builder<Staff>  $query
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
