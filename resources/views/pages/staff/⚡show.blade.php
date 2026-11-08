<?php

use App\Models\Staff;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Staff Details')] class extends Component {
    public Staff $staff;

    public function mount(Staff $staff): void
    {
        $this->authorize('view', $staff);

        $this->staff = $staff->load('user');
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('staff.index')" wire:navigate>
                {{ __('Staff') }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ $staff->name }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ __('Details') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div class="flex flex-col gap-1">
                <flux:heading size="xl" level="1">{{ $staff->name }}</flux:heading>
                <flux:text>{{ __('Staff details') }}</flux:text>
            </div>

            <div class="flex gap-2">
                <flux:button :href="route('staff.index')" variant="ghost" wire:navigate>
                    {{ __('Back to staff') }}
                </flux:button>
                @can('update', $staff)
                    <flux:button :href="route('staff.edit', $staff)" variant="primary" icon="pencil-square" wire:navigate>
                        {{ __('Edit staff') }}
                    </flux:button>
                @endcan
            </div>
        </div>

        <flux:card>
            <flux:card.body>
                <dl class="grid gap-6 sm:grid-cols-2">
                    <div class="flex flex-col gap-1">
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Name') }}</dt>
                        <dd class="text-zinc-900 dark:text-white">{{ $staff->name }}</dd>
                    </div>

                    <div class="flex flex-col gap-1">
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Status') }}</dt>
                        <dd>
                            <flux:badge :color="$staff->is_active ? 'green' : 'zinc'">
                                {{ $staff->is_active ? __('Active') : __('Inactive') }}
                            </flux:badge>
                        </dd>
                    </div>

                    <div class="flex flex-col gap-1">
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Assigned user') }}</dt>
                        <dd class="text-zinc-900 dark:text-white">
                            @if ($staff->user)
                                {{ $staff->user->name }}
                                <span class="text-sm text-zinc-500 dark:text-zinc-400">
                                    ({{ $staff->user->email }})
                                </span>
                            @else
                                {{ __('No user assigned') }}
                            @endif
                        </dd>
                    </div>

                    <div class="flex flex-col gap-1">
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Created') }}</dt>
                        <dd class="text-zinc-900 dark:text-white">{{ $staff->created_at->format('M j, Y') }}</dd>
                    </div>
                </dl>
            </flux:card.body>
        </flux:card>
    </div>
</div>
