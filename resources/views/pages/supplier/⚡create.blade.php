<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Supplier;
use App\Livewire\Forms\SupplierForm;

new #[Title('New Supplier')] 
    class extends Component
{
    public SupplierForm $form;

     public function mount()
    {
        $this->authorize('create', Supplier::class);
    }

    public function save()
    {
        $supplier = $this->form->store();

        Flux::toast(variant: 'success', heading: 'Create', text: "\"{$supplier->name}\" " . __('has been created.'));

        $this->redirectRoute('suppliers.index', navigate: true);
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        {{-- HEADER --}}
        
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('suppliers.index')" wire:navigate>
                {{ __('Supplier') }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ __('New') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <flux:heading size='xl' level='1' class="mb-6">{{ __('New Supplier') }}</flux:heading>

    <form wire:submit="save" class="space-y-6">
        @include('pages.supplier.partials.form')
        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
            <flux:button :href="route('suppliers.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
            <flux:button type="submit" variant="primary">{{ __('Create supplier') }}</flux:button>
        </div>

    </form>
</div>