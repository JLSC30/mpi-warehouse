<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Category;
use App\Livewire\Forms\CategoryForm;

new #[Title('New Category')] 
    class extends Component
{
    public CategoryForm $form;

     public function mount()
    {
        $this->authorize('create', Category::class);
    }

    public function save()
    {
        $category = $this->form->store();

        Flux::toast(variant: 'success', heading: 'Create', text: "\"{$category->name}\" " . __('has been created.'));

        $this->redirectRoute('categories.index', navigate: true);
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        {{-- HEADER --}}
        
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('categories.index')" wire:navigate>
                {{ __('Category') }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ __('New') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <flux:heading size='xl' level='1' class="mb-6">{{ __('New Category') }}</flux:heading>

    <form wire:submit="save" class="space-y-6">
        @include('pages.category.partials.form')
        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
            <flux:button :href="route('categories.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
            <flux:button type="submit" variant="primary">{{ __('Create category') }}</flux:button>
        </div>

    </form>
</div>