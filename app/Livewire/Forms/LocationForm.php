<?php

namespace App\Livewire\Forms;

use App\Concerns\Custom\LocationValidationRules;
use App\Models\Location;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Locked;
use Livewire\Form;
use LogicException;

class LocationForm extends Form
{
    use LocationValidationRules;

    #[Locked]
    public ?Location $location = null;

    public string $name = '';

    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function rules(): array
    {
        return $this->locationRules($this->location);
    }

    public function store(): Location
    {
        $this->validate();

        if (Location::onlyTrashed()->where('name', $this->name)->exists()) {
            throw ValidationException::withMessages([
                'name' => 'This name belongs to a trashed location. Restore it from the trashed instead of creating a duplicate.',
            ]);
        }

        $location = Location::create([
            'name' => $this->name,
        ]);

        $this->reset();

        return $location;
    }

    public function setLocation(Location $location): void
    {
        $this->location = $location;
        $this->name = $location->name;
    }

    public function update(): Location
    {
        $location = $this->location;

        if ($location === null) {
            throw new LogicException('A location must be set before it can be updated.');
        }

        $this->validate();

        if (Location::onlyTrashed()->where('name', $this->name)->exists()) {
            throw ValidationException::withMessages([
                'name' => 'This name belongs to a trashed location. Restore it from the trashed instead of creating a duplicate.',
            ]);
        }

        $location->update([
            'name' => $this->name,
        ]);

        $this->reset();

        return $location;
    }
}
