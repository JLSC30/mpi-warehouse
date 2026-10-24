<flux:card body="seamless">
    <flux:card.body class="space-y-4">
        <flux:input wire:model="form.name" name="name" :label="__('Name')" autofocus />
        <flux:error name="form.name" />
        <flux:input wire:model="form.code" name="code" :label="__('Code')"
            :description="__('Letters, numbers and dashes, e.g. MPI-1042')"  />
        <flux:error name="form.code" />
    </flux:card.body>
</flux:card>