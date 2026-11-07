<div class="flex gap-3 sm:flex-cols-[1fr_12rem_12rem_auto]">
    <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
        :placeholder="$placeholder" />

    @if ($search)
        <flux:button wire:click="clearFilters" variant="subtle" icon='x-mark' />
    @endif
</div>
