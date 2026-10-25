<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Location;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Url;


new #[Title('Location List')] 
    class extends Component {

    use WithPagination;


    #[Url(except: '')]
    public string $search = '';

    #[Computed]
    public function getLocations()
    {
        return Location::query()
        ->filter($this->filters())
        ->orderBy('created_at','desc')
        ->paginate(5);
    }

    private function filters(): array
    {
        return $this->only(['search', 'name']);
    }

    public function clearFilters(): void
    {
        $this->reset('search');
        $this->resetPage();
    }

    public ?int $deletingId = null;

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        Flux::modal('delete-location')->show();
    }

    public function delete(): void
    {
        $location = Location::findOrFail($this->deletingId);
        $this->authorize('delete', $location);
        $location->delete();

        $this->deletingId = null;
        Flux::modal('delete-location')->close();
        Flux::toast(variant: 'success', heading: 'Delete', text: "\"{$location->name}\" was moved to the trash.");
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <flux:heading size="xl" level="1">
                    {{ __('Locations') }}
                </flux:heading>

                <flux:text class="mt-1">
                    {{ trans_choice('{0} No location found|{1} 1 location|[2,*] :count locations', $this->getLocations->total()) }}
                </flux:text>
            </div>
            
            <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
                <flux:button :href="route('locations.create')" variant="primary" icon="plus" wire:navigate>
                    {{ __('New Location') }}
                </flux:button>
            </div>
        </div>

        <div class="flex gap-3 sm:flex-cols-[1fr_12rem_12rem_auto]">
            <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                :placeholder="__('Search by name...')" />

            @if ($search)
                <flux:button wire:click="clearFilters" variant="subtle" icon='x-mark' />
            @endif
        </div>

        @if ($this->getLocations->isNotEmpty())
            <ul class="mt-2 divide-y divide-zinc-200 overflow-hidden rounded-xl border border-zinc-200 dark:divide-zinc-700 dark:border-zinc-700">
                @foreach ($this->getLocations as $location)
                    <li class="flex items-center justify-between gap-4 bg-white px-3 py-3 transition-colors hover:bg-zinc-50 dark:bg-zinc-800 dark:hover:bg-zinc-700/40 sm:px-6"
                        wire:key="location-{{ $location->id }}">
                        <div class="flex min-w-0 flex-col gap-1">
                            <span class="truncate font-medium text-zinc-900 dark:text-white">
                                {{ $location->name }}
                            </span>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <flux:dropdown position="bottom" align="end">
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal"
                                        inset="top bottom"
                                        :aria-label="__('Actions for :name', ['name' => $location->name])" />

                                    <flux:menu>
                                        @can('update', $location)
                                            <flux:menu.item icon="pencil-square" :href="route('locations.edit', $location)"
                                                wire:navigate>{{ __('Edit') }}</flux:menu.item>
                                        @endcan
                                        @can('delete', $location)
                                            <flux:menu.separator />
                                            <flux:menu.item icon="trash" wire:click="confirmDelete({{ $location->id }})"
                                                variant="danger">{{ __('Delete') }}</flux:menu.item>
                                        @endcan
                                    </flux:menu>
                                </flux:dropdown>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if ($this->getLocations->hasPages())
                <div class="w-full overflow-x-auto">
                    <flux:pagination :paginator="$this->getLocations" />
                </div>
            @endif
        @else
            <div class="rounded-xl border border-dashed border-zinc-300 px-4 py-12 text-center dark:border-zinc-700">
                <flux:text>{{ __('No locations found.') }}</flux:text>
            </div>
        @endif

    </div>

    {{-- Delete modal --}}
    <flux:modal name="delete-location" class="max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Delete this location?') }}</flux:heading>
                <flux:text class="mt-2 text-zinc-500 dark:text-zinc-200">
                    {{ __('It will be moved to the trash. You can restore it from there later.') }}
                </flux:text>
            </div>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>
                <flux:button wire:click="delete" variant="danger" data-test="confirm-delete-location">
                    {{ __('Move to trash') }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
