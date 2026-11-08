<?php

namespace App\Concerns\Custom;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait StaffValidationRules
{
    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function staffRules(?Staff $staff = null): array
    {
        return [
            'name' => ['required', 'string', 'max:32', Rule::unique(Staff::class)->ignore($staff)->where(fn ($query) => $query->whereNull('deleted_at'))],
            'is_active' => ['boolean'],
            'user_id' => ['nullable', 'integer', Rule::exists(User::class, 'id'), Rule::unique(Staff::class, 'user_id')->ignore($staff)->where(fn ($query) => $query->whereNull('deleted_at'))],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function staffFormErrorMessage(): array
    {
        return [
            'user_id.unique' => 'The selected user is already assigned to another staff member.',
            'user_id.exists' => 'The selected user does not exist.',
        ];
    }
}
