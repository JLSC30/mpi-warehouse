<?php
if (!function_exists('__db89d604b9914dfe5417896a5a5f6dd9')):
function __db89d604b9914dfe5417896a5a5f6dd9($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
extract(Flux::forwardedAttributes($attributes, [
    'name',
    'descriptionTrailing',
    'description',
    'label',
    'badge',
]));
?>

<?php $descriptionTrailing = $descriptionTrailing ??= $attributes->pluck('description:trailing'); ?>

<?php
$__defaults = [
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'descriptionTrailing' => null,
    'description' => null,
    'label' => null,
    'badge' => null,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
$descriptionTrailing ??= $attributes['description-trailing'] ?? $attributes['descriptionTrailing'] ?? $__defaults['descriptionTrailing']; unset($attributes['descriptionTrailing'], $attributes['description-trailing']);
$description ??= $attributes['description'] ?? $__defaults['description']; unset($attributes['description']);
$label ??= $attributes['label'] ?? $__defaults['label']; unset($attributes['label']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
unset($__defaults);
?>

<?php if (isset($label) || isset($description) || isset($descriptionTrailing)): ?>
    <?php

        $fieldAttributes = Flux::attributesAfter('field:', $attributes, []);
        $labelAttributes = Flux::attributesAfter('label:', $attributes, ['badge' => $badge]);
        $descriptionAttributes = Flux::attributesAfter('description:', $attributes, []);
        $errorAttributes = Flux::attributesAfter('error:', $attributes, ['name' => $name]);
    ?>
    <?php if (!function_exists('__73717f669372c6ad024dc40667e91ffd')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/field.blade.php', $__blaze->compiledPath.'/73717f669372c6ad024dc40667e91ffd.php'); require $__blaze->compiledPath.'/73717f669372c6ad024dc40667e91ffd.php'; } ?>
<?php if (isset($__slots73717f669372c6ad024dc40667e91ffd)) { $__slotsStack73717f669372c6ad024dc40667e91ffd[] = $__slots73717f669372c6ad024dc40667e91ffd; } ?>
<?php if (isset($__attrs73717f669372c6ad024dc40667e91ffd)) { $__attrsStack73717f669372c6ad024dc40667e91ffd[] = $__attrs73717f669372c6ad024dc40667e91ffd; } ?>
<?php $__attrs73717f669372c6ad024dc40667e91ffd = ['attributes' => $fieldAttributes]; ?>
<?php $__slots73717f669372c6ad024dc40667e91ffd = []; ?>
<?php $__blaze->pushData($__attrs73717f669372c6ad024dc40667e91ffd); ?>
<?php ob_start(); ?>
        <?php if (isset($label)): ?>
            <?php if (!function_exists('__54820fc81d9780c2e7c0025b3c095048')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/label.blade.php', $__blaze->compiledPath.'/54820fc81d9780c2e7c0025b3c095048.php'); require $__blaze->compiledPath.'/54820fc81d9780c2e7c0025b3c095048.php'; } ?>
<?php if (isset($__slots54820fc81d9780c2e7c0025b3c095048)) { $__slotsStack54820fc81d9780c2e7c0025b3c095048[] = $__slots54820fc81d9780c2e7c0025b3c095048; } ?>
<?php if (isset($__attrs54820fc81d9780c2e7c0025b3c095048)) { $__attrsStack54820fc81d9780c2e7c0025b3c095048[] = $__attrs54820fc81d9780c2e7c0025b3c095048; } ?>
<?php $__attrs54820fc81d9780c2e7c0025b3c095048 = ['attributes' => $labelAttributes]; ?>
<?php $__slots54820fc81d9780c2e7c0025b3c095048 = []; ?>
<?php $__blaze->pushData($__attrs54820fc81d9780c2e7c0025b3c095048); ?>
<?php ob_start(); ?><?php echo e($label); ?><?php $__slots54820fc81d9780c2e7c0025b3c095048['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots54820fc81d9780c2e7c0025b3c095048); ?>
<?php __54820fc81d9780c2e7c0025b3c095048($__blaze, $__attrs54820fc81d9780c2e7c0025b3c095048, $__slots54820fc81d9780c2e7c0025b3c095048, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack54820fc81d9780c2e7c0025b3c095048)) { $__slots54820fc81d9780c2e7c0025b3c095048 = array_pop($__slotsStack54820fc81d9780c2e7c0025b3c095048); } ?>
<?php if (! empty($__attrsStack54820fc81d9780c2e7c0025b3c095048)) { $__attrs54820fc81d9780c2e7c0025b3c095048 = array_pop($__attrsStack54820fc81d9780c2e7c0025b3c095048); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <?php if (!function_exists('__e125dd0879faa096f9bebe1f051c674b')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/e125dd0879faa096f9bebe1f051c674b.php'); require $__blaze->compiledPath.'/e125dd0879faa096f9bebe1f051c674b.php'; } ?>
<?php if (isset($__slotse125dd0879faa096f9bebe1f051c674b)) { $__slotsStacke125dd0879faa096f9bebe1f051c674b[] = $__slotse125dd0879faa096f9bebe1f051c674b; } ?>
<?php if (isset($__attrse125dd0879faa096f9bebe1f051c674b)) { $__attrsStacke125dd0879faa096f9bebe1f051c674b[] = $__attrse125dd0879faa096f9bebe1f051c674b; } ?>
<?php $__attrse125dd0879faa096f9bebe1f051c674b = ['attributes' => $descriptionAttributes]; ?>
<?php $__slotse125dd0879faa096f9bebe1f051c674b = []; ?>
<?php $__blaze->pushData($__attrse125dd0879faa096f9bebe1f051c674b); ?>
<?php ob_start(); ?><?php echo e($description); ?><?php $__slotse125dd0879faa096f9bebe1f051c674b['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotse125dd0879faa096f9bebe1f051c674b); ?>
<?php __e125dd0879faa096f9bebe1f051c674b($__blaze, $__attrse125dd0879faa096f9bebe1f051c674b, $__slotse125dd0879faa096f9bebe1f051c674b, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacke125dd0879faa096f9bebe1f051c674b)) { $__slotse125dd0879faa096f9bebe1f051c674b = array_pop($__slotsStacke125dd0879faa096f9bebe1f051c674b); } ?>
<?php if (! empty($__attrsStacke125dd0879faa096f9bebe1f051c674b)) { $__attrse125dd0879faa096f9bebe1f051c674b = array_pop($__attrsStacke125dd0879faa096f9bebe1f051c674b); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php echo e($slot); ?>


        
        [STARTCOMPILEDUNBLAZE:pkMqYdqOaH]<?php \Livewire\Blaze\Unblaze::storeScope("pkMqYdqOaH", scope: ['attributes' => $errorAttributes->getAttributes()]) ?><?php \Livewire\Blaze\Unblaze::storeReplacement("pkMqYdqOaH", "CiAgICAgICAgPGZsdXg6ZXJyb3IgOmF0dHJpYnV0ZXM9Im5ldyBcSWxsdW1pbmF0ZVxWaWV3XENvbXBvbmVudEF0dHJpYnV0ZUJhZygkc2NvcGVbJ2F0dHJpYnV0ZXMnXSkiIC8+CiAgICAgICAg") ?>[ENDCOMPILEDUNBLAZE:pkMqYdqOaH]

        <?php if (isset($descriptionTrailing)): ?>
            <?php if (!function_exists('__e125dd0879faa096f9bebe1f051c674b')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/e125dd0879faa096f9bebe1f051c674b.php'); require $__blaze->compiledPath.'/e125dd0879faa096f9bebe1f051c674b.php'; } ?>
<?php if (isset($__slotse125dd0879faa096f9bebe1f051c674b)) { $__slotsStacke125dd0879faa096f9bebe1f051c674b[] = $__slotse125dd0879faa096f9bebe1f051c674b; } ?>
<?php if (isset($__attrse125dd0879faa096f9bebe1f051c674b)) { $__attrsStacke125dd0879faa096f9bebe1f051c674b[] = $__attrse125dd0879faa096f9bebe1f051c674b; } ?>
<?php $__attrse125dd0879faa096f9bebe1f051c674b = ['attributes' => $descriptionAttributes]; ?>
<?php $__slotse125dd0879faa096f9bebe1f051c674b = []; ?>
<?php $__blaze->pushData($__attrse125dd0879faa096f9bebe1f051c674b); ?>
<?php ob_start(); ?><?php echo e($descriptionTrailing); ?><?php $__slotse125dd0879faa096f9bebe1f051c674b['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotse125dd0879faa096f9bebe1f051c674b); ?>
<?php __e125dd0879faa096f9bebe1f051c674b($__blaze, $__attrse125dd0879faa096f9bebe1f051c674b, $__slotse125dd0879faa096f9bebe1f051c674b, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacke125dd0879faa096f9bebe1f051c674b)) { $__slotse125dd0879faa096f9bebe1f051c674b = array_pop($__slotsStacke125dd0879faa096f9bebe1f051c674b); } ?>
<?php if (! empty($__attrsStacke125dd0879faa096f9bebe1f051c674b)) { $__attrse125dd0879faa096f9bebe1f051c674b = array_pop($__attrsStacke125dd0879faa096f9bebe1f051c674b); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slots73717f669372c6ad024dc40667e91ffd['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots73717f669372c6ad024dc40667e91ffd); ?>
<?php __73717f669372c6ad024dc40667e91ffd($__blaze, $__attrs73717f669372c6ad024dc40667e91ffd, $__slots73717f669372c6ad024dc40667e91ffd, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack73717f669372c6ad024dc40667e91ffd)) { $__slots73717f669372c6ad024dc40667e91ffd = array_pop($__slotsStack73717f669372c6ad024dc40667e91ffd); } ?>
<?php if (! empty($__attrsStack73717f669372c6ad024dc40667e91ffd)) { $__attrs73717f669372c6ad024dc40667e91ffd = array_pop($__attrsStack73717f669372c6ad024dc40667e91ffd); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php ENDPATH**/ ?>