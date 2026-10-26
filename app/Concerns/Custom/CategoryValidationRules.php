<?php

namespace App\Concerns\Custom;

use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait CategoryValidationRules
{
    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function categoryRules(?Category $category = null): array
    {
        return [
            'name' => ['required', 'string', 'max:32'],
            'code' => ['required', 'string', 'alpha_dash', 'max:16', Rule::unique(Category::class)->ignore($category)->where(fn ($query) => $query->whereNull('deleted_at'))],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function categoryFormErrorMessage(): array
    {
        return [
            'code.alpha_dash' => 'The code may only contain letters, numbers, dashes and underscores.',
        ];
    }
}
