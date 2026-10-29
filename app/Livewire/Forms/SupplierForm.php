<?php

namespace App\Livewire\Forms;

use App\Concerns\Custom\SupplierValidationRules;
use App\Livewire\Forms\Concerns\RejectTrashedValue;
use App\Models\Supplier;
use Illuminate\Contracts\Validation\ValidationRule;
use Livewire\Attributes\Locked;
use Livewire\Form;
use LogicException;

class SupplierForm extends Form
{
    use RejectTrashedValue, SupplierValidationRules;

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

        $this->rejectTrashedValue(Supplier::class, 'name', $this->name, 'supplier');

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

        $this->rejectTrashedValue(Supplier::class, 'name', $this->name, 'supplier');

        $supplier->update([
            'name' => $this->name,
        ]);

        $this->reset();

        return $supplier;
    }
}
