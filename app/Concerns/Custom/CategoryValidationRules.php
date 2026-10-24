<?php

namespace App\Concerns\Custom;

use App\Models\Category;
use Illuminate\Validation\Rule;

trait CategoryValidationRules
{
    protected function categoryRules(?Category $category = null): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:32'],
            'code' => ['required', 'string', 'alpha_dash', 'max:16', Rule::unique(Category::class)->ignore($category)],
        ];

        return $rules;
    }

    /**
     * Return the custom validation messages used for product form errors.
     */
    protected function categoryFormErrorMessage(): array
    {
        return [
            'code.alpha_dash' => 'The code may only contain letters, numbers, dashes and underscores.',
        ];
    }
}
