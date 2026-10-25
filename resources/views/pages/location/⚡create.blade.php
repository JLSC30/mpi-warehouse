<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Location;
use App\Livewire\Forms\LocationForm;

new #[Title('New Location')] 
    class extends Component
{
    public LocationForm $form;

     public function mount()
    {
        $this->authorize('create', Location::class);
    }

    public function save()
    {
        $location = $this->form->store();

        Flux::toast(variant: 'success', heading: 'Create', text: "\"{$location->name}\" " . __('has been created.'));

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
                {{ __('New') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <flux:heading size='xl' level='1' class="mb-6">{{ __('New Location') }}</flux:heading>

    <form wire:submit="save" class="space-y-6">
        @include('pages.location.partials.form')
        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
            <flux:button :href="route('locations.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
            <flux:button type="submit" variant="primary">{{ __('Create location') }}</flux:button>
        </div>

    </form>
</div>