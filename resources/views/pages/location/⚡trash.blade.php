<?php

use Livewire\Component;

use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\Location;
use Livewire\Attributes\Url;
use Flux\Flux;

new #[Title('Location Trash')] class extends Component {
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    #[Computed]
    public function getLocations()
    {
        return Location::onlyTrashed()->latest('deleted_at')->filter($this->filters())->paginate(5);
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

    public function restore(int $id): void
    {
        $location = Location::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $location);

        $location->restore();

        Flux::toast(variant: 'success', heading: 'Restore', text: "\"{$location->name}\" was restored.");
    }

    public ?int $deletingId = null;

    public function confirmForceDelete(int $id): void
    {
        $this->deletingId = $id;

        Flux::modal('force-delete')->show();
    }

    public function forceDelete(): void
    {
        $location = Location::onlyTrashed()->findOrFail($this->deletingId);

        $this->authorize('forceDelete', $location);

        $location->forceDelete();

        $this->deletingId = null;
        Flux::modal('force-delete')->close();
        Flux::toast(variant: 'success', heading: 'Force delete', text: "\"{$location->name}\" was permanently deleted.");
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
                {{ __('Trash') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        
        <flux:callout variant="danger" icon="x-circle"
            :heading="__('Deleted locations stay here until you restore them or delete them for good.')" />

        <div class="flex gap-3 sm:flex-cols-[1fr_12rem_12rem_auto]">
            <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                :placeholder="__('Search by name...')" />

            @if ($search)
                <flux:button wire:click="clearFilters" variant="subtle" icon='x-mark' />
            @endif
        </div>

        @if ($this->getLocations->isNotEmpty())
            <ul
                class="mt-2 divide-y divide-zinc-200 overflow-hidden rounded-xl border border-zinc-200 dark:divide-zinc-700 dark:border-zinc-700">
                @foreach ($this->getLocations as $location)
                    <li class="flex items-center justify-between gap-4 bg-white px-3 py-3 transition-colors hover:bg-zinc-50 dark:bg-zinc-800 dark:hover:bg-zinc-700/40 sm:px-6"
                        wire:key="location-{{ $location->id }}">
                        <div class="flex min-w-0 flex-col gap-1">
                            <span class="truncate font-medium text-zinc-900 dark:text-white">
                                {{ $location->name }}
                            </span>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400">
                                {{ __('Deleted :item', ['item' => $location->deleted_at->diffForHumans()]) }}
                            </span>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <flux:dropdown position="bottom" align="end">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal"
                                    inset="top bottom"
                                    :aria-label="__('Actions for :name', ['name' => $location->name])" />

                                <flux:menu>
                                    @can('restore', $location)
                                        <flux:menu.item icon="arrow-uturn-left" size="sm"
                                            wire:click="restore({{ $location->id }})">{{ __('Restore') }}</flux:menu.item>
                                    @endcan
                                    @can('forceDelete', $location)
                                        <flux:menu.separator />
                                        <flux:menu.item icon="trash" size="sm"
                                            wire:click="confirmForceDelete({{ $location->id }})" variant="danger">
                                            {{ __('Delete forever') }}</flux:menu.item>
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
                <flux:text>{{ __('Trash is empty.') }}</flux:text>
            </div>
        @endif

    </div>

    {{-- Delete modal --}}
    <flux:modal name="force-delete" class="max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Delete this location forever?') }}</flux:heading>
                <flux:text class="mt-2 text-zinc-500 dark:text-zinc-200">
                    {{ __('The location will be gone for good. This action cannot be undone.') }}
                </flux:text>
            </div>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>
                <flux:button wire:click="forceDelete" variant="danger">
                    {{ __('Delete forever') }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
