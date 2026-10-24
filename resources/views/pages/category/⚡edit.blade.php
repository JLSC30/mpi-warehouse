<?php

use Livewire\Component;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;


new #[Title('Edit Category')]
    class extends Component
{
    public CategoryForm $form;

     public function mount(Category $category): void
    {
        $this->authorize('update', $category);

        $this->form->setCategory($category);
    }

    public function save(): void
    {
        $this->authorize('update', $this->form->category);
        $category = $this->form->update();
        Flux::toast(variant: 'success', heading: 'Update', text: "\"{$category->name}\" updated successfully!");

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
                {{ $form->category->name }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ __('Edit') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:heading size='xl' level='1' class="mb-6">{{ __('Edit :name', ['name' => $form->category->name]) }}</flux:heading>

        <form wire:submit="save" class="space-y-6">
        @include('pages.category.partials.form')
        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
            <flux:text wire:dirty wire:target="form" class="me-auto">{{ __('You have unsaved changes.')}}</flux:text>
            <flux:button :href="route('categories.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
            <flux:button type="submit" variant="primary">{{ __('Update category') }}</flux:button>
        </div>

    </form>
    </div>
</div>