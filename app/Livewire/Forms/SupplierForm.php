<?php

namespace App\Livewire\Forms;

use App\Concerns\Custom\SupplierValidationRules;
use App\Models\Supplier;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Locked;
use Livewire\Form;
use LogicException;

class SupplierForm extends Form
{
    use SupplierValidationRules;

    #[Locked]
    public ?Supplier $supplier = null;

    public string $name = '';

    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function rules(): array
    {
        return $this->supplierRules($this->supplier);
    }

    public function store(): Supplier
    {
        $this->validate();

        if (Supplier::onlyTrashed()->where('name', $this->name)->exists()) {
            throw ValidationException::withMessages([
                'name' => 'This name belongs to a trashed supplier. Restore it from the trashed instead of creating a duplicate.',
            ]);
        }

        $supplier = Supplier::create([
            'name' => $this->name,
        ]);

        $this->reset();

        return $supplier;
    }

    public function setSupplier(Supplier $supplier): void
    {
        $this->supplier = $supplier;
        $this->name = $supplier->name;
    }

    public function update(): Supplier
    {
        $supplier = $this->supplier;

        if ($supplier === null) {
            throw new LogicException('A supplier must be set before it can be updated.');
        }

        $this->validate();

        if (Supplier::onlyTrashed()->where('name', $this->name)->exists()) {
            throw ValidationException::withMessages([
                'name' => 'This name belongs to a trashed supplier. Restore it from the trashed instead of creating a duplicate.',
            ]);
        }

        $supplier->update([
            'name' => $this->name,
        ]);

        $this->reset();

        return $supplier;
    }
}
