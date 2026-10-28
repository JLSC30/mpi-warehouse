<?php

namespace App\Livewire\Forms;

use App\Concerns\Custom\LocationValidationRules;
use App\Livewire\Forms\Concerns\RejectTrashedValue;
use App\Models\Location;
use Illuminate\Contracts\Validation\ValidationRule;
use Livewire\Attributes\Locked;
use Livewire\Form;
use LogicException;

class LocationForm extends Form
{
    use LocationValidationRules, RejectTrashedValue;

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

        $this->rejectTrashedValue(Location::class, 'name', $this->name, 'location');

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

        $this->rejectTrashedValue(Location::class, 'name', $this->name, 'location');

        $location->update([
            'name' => $this->name,
        ]);

        $this->reset();

        return $location;
    }
}
