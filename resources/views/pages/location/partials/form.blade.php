<flux:card body="seamless">
    <flux:card.body class="space-y-4">
        <flux:input wire:model="form.name" name="name" :label="__('Name')" autofocus />
        <flux:error name="form.name" />
    </flux:card.body>
</flux:card>