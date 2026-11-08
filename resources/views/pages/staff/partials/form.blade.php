<flux:card body="seamless">
    <flux:card.body class="space-y-4">
        <flux:input wire:model="form.name" name="name" :label="__('Name')" autofocus />
        <flux:error name="form.name" />

        <flux:checkbox wire:model="form.is_active" name="is_active" :label="__('Active')" />
        <flux:error name="form.is_active" />

        <flux:field>
            <flux:label>{{ __('Search users') }}</flux:label>
            <flux:input wire:model.live.debounce.300ms="userSearch" type="search" icon="magnifying-glass"
                :placeholder="__('Search by name or email...')" />
        </flux:field>

        <flux:select wire:model="form.user_id" name="user_id" :label="__('User')">
            <flux:select.option value="">
                Select a user (optional)
            </flux:select.option>
            @foreach ($this->users as $user)
                <flux:select.option :value="$user->id" wire:key="staff-user-{{ $user->id }}">
                    {{ $user->name }} ({{ $user->email }})
                </flux:select.option>
            @endforeach
        </flux:select>
        <flux:error name="form.user_id" />


    </flux:card.body>
</flux:card>
