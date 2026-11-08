<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Staff;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Flux\Flux;

new #[Title('Staff List')] class extends Component {
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    #[Computed]
    public function getStaff()
    {
        return Staff::query()->filter($this->filters())->orderBy('created_at', 'desc')->paginate(5);
    }

    private function filters(): array
    {
        return ['search' => $this->search];
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
        Flux::modal('delete-staff')->show();
    }

    public function delete(): void
    {
        if ($this->deletingId === null) {
            return;
        }

        $staff = Staff::findOrFail($this->deletingId);
        $this->authorize('delete', $staff);
        $staff->delete();

        $this->deletingId = null;
        Flux::modal('delete-staff')->close();
        Flux::toast(variant: 'success', heading: 'Delete', text: "\"{$staff->name}\" was moved to the trash.");
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <flux:heading size="xl" level="1">
                    {{ __('Staff') }}
                </flux:heading>

                <flux:text class="mt-1">
                    {{ trans_choice('{0} No staff found|{1} 1 staff|[2,*] :count staff', $this->getStaff->total()) }}
                </flux:text>
            </div>

            <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
                <flux:button :href="route('staff.create')" variant="primary" icon="plus" wire:navigate>
                    {{ __('New Staff') }}
                </flux:button>
            </div>
        </div>

        @include('pages.partials.search-bar', ['placeholder' => __('Search by name...')])


        @if ($this->getStaff->isNotEmpty())
            <ul
                class="mt-2 divide-y divide-zinc-200 overflow-hidden rounded-xl border border-zinc-200 dark:divide-zinc-700 dark:border-zinc-700">
                @foreach ($this->getStaff as $staff)
                    <li class="flex items-center justify-between gap-4 bg-white px-3 py-3 transition-colors hover:bg-zinc-50 dark:bg-zinc-800 dark:hover:bg-zinc-700/40 sm:px-6"
                        wire:key="staff-{{ $staff->id }}">
                        <div class="flex min-w-0 flex-col gap-1">
                            <span class="truncate font-medium text-zinc-900 dark:text-white">
                                {{ $staff->name }}
                            </span>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                {{ $staff->is_active ? __('Active staff') : __('Inactive staff') }}
                            </p>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <flux:dropdown position="bottom" align="end">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal"
                                    inset="top bottom"
                                    :aria-label="__('Actions for :name', ['name' => $staff->name])" />

                                <flux:menu>
                                    @can('view', $staff)
                                        <flux:menu.item icon="eye" :href="route('staff.show', $staff)" wire:navigate>
                                            {{ __('View') }}</flux:menu.item>
                                    @endcan
                                    @can('update', $staff)
                                        <flux:menu.item icon="pencil-square" :href="route('staff.edit', $staff)"
                                            wire:navigate>{{ __('Edit') }}</flux:menu.item>
                                    @endcan
                                    @can('delete', $staff)
                                        <flux:menu.separator />
                                        <flux:menu.item icon="trash" wire:click="confirmDelete({{ $staff->id }})"
                                            variant="danger">{{ __('Delete') }}</flux:menu.item>
                                    @endcan
                                </flux:menu>
                            </flux:dropdown>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if ($this->getStaff->hasPages())
                <div class="w-full overflow-x-auto">
                    <flux:pagination :paginator="$this->getStaff" />
                </div>
            @endif
        @else
            @include('pages.partials.empty-state', ['message' => __('No staff found.')])
        @endif


    </div>

    {{-- Delete modal --}}
    <flux:modal name="delete-staff" class="max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Delete this staff?') }}</flux:heading>
                <flux:text class="mt-2 text-zinc-500 dark:text-zinc-200">
                    {{ __('It will be moved to the trash. You can restore it from there later.') }}
                </flux:text>
            </div>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>
                <flux:button wire:click="delete" variant="danger" data-test="confirm-delete-staff">
                    {{ __('Move to trash') }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
