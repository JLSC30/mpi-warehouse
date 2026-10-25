<?php

namespace App\Concerns\Custom;

use App\Models\Location;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait LocationValidationRules
{
    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function locationRules(?Location $location = null): array
    {
        return [
            'name' => ['required', 'string', 'max:32', Rule::unique(Location::class)->ignore($location)],
        ];
    }
}
