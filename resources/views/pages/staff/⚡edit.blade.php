<?php

use Livewire\Component;
use App\Livewire\Forms\StaffForm;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

new #[Title('Edit Staff')] class extends Component {
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
            ->when($search !== '', fn(Builder $query) => $query->where(fn(Builder $query) => $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%")))
            ->orderBy('name')
            ->limit(20)
            ->get(['id', 'name', 'email']);

        if ($this->form->user_id !== null && !$users->contains('id', $this->form->user_id)) {
            $selectedUser = User::query()->find($this->form->user_id, ['id', 'name', 'email']);

            if ($selectedUser !== null) {
                $users->prepend($selectedUser);
            }
        }

        return $users;
    }

    public function mount(Staff $staff): void
    {
        $this->authorize('update', $staff);

        $this->form->setStaff($staff);
    }

    public function save(): void
    {
        $this->authorize('update', $this->form->staff);
        $staff = $this->form->update();
        Flux::toast(variant: 'success', heading: 'Update', text: "\"{$staff->name}\" updated successfully!");

        $this->redirectRoute('staff.index', navigate: true);
    }
};
?>

<div>
    <div class="flex flex-col gap-6">
        {{-- HEADER --}}

        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('staff.index')" wire:navigate>
                {{ __('Staff') }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ $form->staff->name }}
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ __('Edit') }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <flux:heading size='xl' level='1' class="mb-6">
            {{ __('Edit :name', ['name' => $form->staff->name]) }}</flux:heading>

        <form wire:submit="save" class="space-y-6">
            @include('pages.staff.partials.form')
            <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
                <flux:text wire:dirty wire:target="form" class="me-auto">{{ __('You have unsaved changes.') }}</flux:text>
                <flux:button :href="route('staff.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}
                </flux:button>
                <flux:button type="submit" variant="primary">{{ __('Update staff') }}</flux:button>
            </div>

        </form>
    </div>
</div>
