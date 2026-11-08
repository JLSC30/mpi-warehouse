<?php

namespace App\Livewire\Forms;

use App\Concerns\Custom\StaffValidationRules;
use App\Livewire\Forms\Concerns\RejectTrashedValue;
use App\Models\Staff;
use Illuminate\Contracts\Validation\ValidationRule;
use Livewire\Attributes\Locked;
use Livewire\Form;
use LogicException;

class StaffForm extends Form
{
    use RejectTrashedValue, StaffValidationRules;

    #[Locked]
    public ?Staff $staff = null;

    public string $name = '';

    public bool $is_active = true;

    public ?int $user_id = null;

    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function rules(): array
    {
        return $this->staffRules($this->staff);
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return $this->staffFormErrorMessage();
    }

    public function store(): Staff
    {
        $this->validate();

        $this->rejectTrashedValue(Staff::class, 'name', $this->name, 'staff');

        $staff = Staff::create([
            'name' => $this->name,
            'is_active' => $this->is_active,
            'user_id' => $this->user_id,
        ]);

        $this->reset();

        return $staff;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
        $this->name = $staff->name;
        $this->is_active = $staff->is_active;
        $this->user_id = $staff->user_id;
    }

    public function update(): Staff
    {
        $staff = $this->staff;

        if ($staff === null) {
            throw new LogicException('A staff must be set before it can be updated.');
        }

        $this->validate();

        $this->rejectTrashedValue(Staff::class, 'name', $this->name, 'staff');

        $staff->update([
            'name' => $this->name,
            'is_active' => $this->is_active,
            'user_id' => $this->user_id,
        ]);

        $this->reset();

        return $staff;
    }
}
