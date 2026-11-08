<?php

use App\Livewire\Forms\StaffForm;
use App\Models\Staff;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('New Staff')] class extends Component
{
    public StaffForm $form;

    public string $userSearch = '';

    /**
     * @return Collection<int, User>
     */
    #[Computed]
    public function users(): Collection
    {
        $search = trim($this->userSearch);

        $users = User::query()
            ->when($search !== '', fn (Builder $query) => $query->where(
                fn (Builder $query) => $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%"),
            ))
            ->orderBy('name')
            ->limit(20)
            ->get(['id', 'name', 'email']);

        if ($this->form->user_id !== null && ! $users->contains('id', $this->form->user_id)) {
            $selectedUser = User::query()->find($this->form->user_id, ['id', 'name', 'email']);

            if ($selectedUser !== null) {
                $users->prepend($selectedUser);
            }
        }

        return $users;
    }

    public function mount(): void
    {
        $this->authorize('create', Staff::class);
    }

    public function save(): void
    {
        $staff = $this->form->store();

        Flux::toast(variant: 'success', heading: 'Create', text: "\"{$staff->name}\" ".__('has been created.'));

        $this->redirectRoute('staffs.index', navigate: true);
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        {{-- HEADER --}}

        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('staffs.index')" wire:navigate>
                {{ __('Staff') }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ __('New') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <flux:heading size='xl' level='1' class="mb-6">{{ __('New Staff') }}</flux:heading>

    <form wire:submit="save" class="space-y-6">
        @include('pages.staff.partials.form')
        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
            <flux:button :href="route('staffs.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
            <flux:button type="submit" variant="primary">{{ __('Create staff') }}</flux:button>
        </div>

    </form>
</div>
