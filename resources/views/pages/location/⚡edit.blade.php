<?php

use Livewire\Component;
use App\Livewire\Forms\LocationForm;
use App\Models\Location;


new #[Title('Edit Location')]
    class extends Component
{
    public LocationForm $form;

     public function mount(Location $location): void
    {
        $this->authorize('update', $location);

        $this->form->setLocation($location);
    }

    public function save(): void
    {
        $this->authorize('update', $this->form->location);
        $location = $this->form->update();
        Flux::toast(variant: 'success', heading: 'Update', text: "\"{$location->name}\" updated successfully!");

        $this->redirectRoute('locations.index', navigate: true);
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        {{-- HEADER --}}
        
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('locations.index')" wire:navigate>
                {{ __('Location') }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ $form->location->name }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ __('Edit') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:heading size='xl' level='1' class="mb-6">{{ __('Edit :name', ['name' => $form->location->name]) }}</flux:heading>

        <form wire:submit="save" class="space-y-6">
        @include('pages.location.partials.form')
        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
            <flux:text wire:dirty wire:target="form" class="me-auto">{{ __('You have unsaved changes.')}}</flux:text>
            <flux:button :href="route('locations.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
            <flux:button type="submit" variant="primary">{{ __('Update location') }}</flux:button>
        </div>

    </form>
    </div>
</div>