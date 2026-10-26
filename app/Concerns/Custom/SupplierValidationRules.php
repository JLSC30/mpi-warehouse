<?php

namespace App\Concerns\Custom;

use App\Models\Supplier;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait SupplierValidationRules
{
    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function supplierRules(?Supplier $supplier = null): array
    {
        return [
            'name' => ['required', 'string', 'max:32', Rule::unique(Supplier::class)->ignore($supplier)],
        ];
    }
}
