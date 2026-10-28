<?php

namespace App\Livewire\Forms\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

trait RejectTrashedValue
{
    /**
     * @param  class-string<Model>  $model
     */
    protected function rejectTrashedValue(string $model, string $field, string $value, string $entity): void
    {
        if ($model::onlyTrashed()->where($field, $value)->exists()) {
            throw ValidationException::withMessages([
                $field => "This {$field} belongs to a trashed {$entity}. Restore it from the trashe instead of creating a duplicate.",
            ]);
        }
    }
}
