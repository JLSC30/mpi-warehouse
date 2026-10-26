<?php

use Livewire\Component;
use App\Livewire\Forms\SupplierForm;
use App\Models\Supplier;


new #[Title('Edit Supplier')]
    class extends Component
{
    public SupplierForm $form;

     public function mount(Supplier $supplier): void
    {
        $this->authorize('update', $supplier);

        $this->form->setSupplier($supplier);
    }

    public function save(): void
    {
        $this->authorize('update', $this->form->supplier);
        $supplier = $this->form->update();
        Flux::toast(variant: 'success', heading: 'Update', text: "\"{$supplier->name}\" updated successfully!");

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
                {{ $form->supplier->name }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ __('Edit') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:heading size='xl' level='1' class="mb-6">{{ __('Edit :name', ['name' => $form->supplier->name]) }}</flux:heading>

        <form wire:submit="save" class="space-y-6">
        @include('pages.supplier.partials.form')
        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
            <flux:text wire:dirty wire:target="form" class="me-auto">{{ __('You have unsaved changes.')}}</flux:text>
            <flux:button :href="route('suppliers.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
            <flux:button type="submit" variant="primary">{{ __('Update supplier') }}</flux:button>
        </div>

    </form>
    </div>
</div>