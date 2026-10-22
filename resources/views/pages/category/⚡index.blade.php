<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Url;


new #[Title('Categories')] 
    class extends Component {

    use WithPagination;
    
    public array $selected = [];

    #[Url(except: '')]
    public string $search = '';
    #[Url(except: 'created')]
    public string $sort = 'created';
    #[Url(except: 'desc')]
    public string $direction = 'desc';

    #[Computed]
    public function getCategories()
    {
        return Category::query()->paginate(5);
    }

    public function sortBy(string $column): void
    {
        $this->direction = $this->sort === $column && $this->direction === 'asc' ? 'desc' : 'asc';
        $this->sort = $column;
        $this->resetPage();
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <flux:heading size="xl" level="1">
                    {{ __('Categories') }}
                </flux:heading>

                <flux:text class="mt-1">
                    {{ trans_choice('{0} No category found|{1} 1 category|[2,*] :count categories', $this->getCategories->total()) }}
                </flux:text>
            </div>
            
            <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
                <flux:button icon="arrow-up-tray">
                    {{ __('Export CSV') }}
                </flux:button>

                <flux:button :href="route('categories.index')" variant="primary" icon="plus" wire:navigate>
                    {{ __('New Category') }}
                </flux:button>
            </div>
        </div>

        <div class="flex gap-3 sm:flex-cols-[1fr_12rem_12rem_auto]">
            <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                :placeholder="__('Search by name or code...')" clearable />
        </div>

        @if ($this->getCategories->isNotEmpty())
            <ul class="mt-2 divide-y divide-zinc-200 overflow-hidden rounded-xl border border-zinc-200 dark:divide-zinc-700 dark:border-zinc-700">
                @foreach ($this->getCategories as $category)
                    <li class="flex items-center justify-between gap-4 bg-white px-3 py-3 transition-colors hover:bg-zinc-50 dark:bg-zinc-800 dark:hover:bg-zinc-700/40 sm:px-6"
                        wire:key="category-{{ $category->id }}">
                        <div class="flex min-w-0 flex-col gap-1">
                            <span class="truncate font-medium text-zinc-900 dark:text-white">
                                {{ $category->name }}
                            </span>
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">
                                {{ $category->code }}
                            </span>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <flux:button size="sm" variant="ghost" icon="pencil-square">
                                {{ __('Edit') }}
                            </flux:button>
                            <flux:button size="sm" variant="danger" icon="trash">
                                {{ __('Delete') }}
                            </flux:button>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if ($this->getCategories->hasPages())
                <div class="w-full overflow-x-auto">
                    <flux:pagination :paginator="$this->getCategories" />
                </div>
            @endif
        @else
            <div class="rounded-xl border border-dashed border-zinc-300 px-4 py-12 text-center dark:border-zinc-700">
                <flux:text>{{ __('No categories found.') }}</flux:text>
            </div>
        @endif

    </div>
</div>
