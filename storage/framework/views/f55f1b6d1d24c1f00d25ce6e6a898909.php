<?php
if (!function_exists('_f55f1b6d1d24c1f00d25ce6e6a898909')):
function _f55f1b6d1d24c1f00d25ce6e6a898909($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
$__defaults = [
    'iconVariant' => 'mini',
    'size' => null,
];
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$size ??= $attributes['size'] ?? $__defaults['size']; unset($attributes['size']);
unset($__defaults);
?>

<?php
$attributes = $attributes->merge([
    'variant' => 'subtle',
    'class' => '-me-1',
    'square' => true,
    'size' => null,
]);
?>

<?php if (!function_exists('_9c85c2ca5108d2bb93efefdd6c4d188e')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/9c85c2ca5108d2bb93efefdd6c4d188e.php'); require $__blaze->compiledPath.'/9c85c2ca5108d2bb93efefdd6c4d188e.php'; } ?>
<?php if (isset($__slots9c85c2ca5108d2bb93efefdd6c4d188e)) { $__slotsStack9c85c2ca5108d2bb93efefdd6c4d188e[] = $__slots9c85c2ca5108d2bb93efefdd6c4d188e; } ?>
<?php if (isset($__attrs9c85c2ca5108d2bb93efefdd6c4d188e)) { $__attrsStack9c85c2ca5108d2bb93efefdd6c4d188e[] = $__attrs9c85c2ca5108d2bb93efefdd6c4d188e; } ?>
<?php $__attrs9c85c2ca5108d2bb93efefdd6c4d188e = ['attributes' => $attributes,'size' => $size === 'sm' || $size === 'xs' ? 'xs' : 'sm','xData' => 'fluxInputViewable','xOn:click' => 'toggle()','xBind:dataViewableOpen' => 'open','ariaLabel' => e(__('Toggle password visibility'))]; ?>
<?php $__slots9c85c2ca5108d2bb93efefdd6c4d188e = []; ?>
<?php $__blaze->pushData($__attrs9c85c2ca5108d2bb93efefdd6c4d188e); ?>
<?php ob_start(); ?>
    <?php if (!function_exists('_17c49d94913c8c970ccdb98c779f647e')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/eye-slash.blade.php', $__blaze->compiledPath.'/17c49d94913c8c970ccdb98c779f647e.php'); require $__blaze->compiledPath.'/17c49d94913c8c970ccdb98c779f647e.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'hidden [[data-viewable-open]>&]:block']); ?>
<?php _17c49d94913c8c970ccdb98c779f647e($__blaze, ['variant' => $iconVariant,'class' => 'hidden [[data-viewable-open]>&]:block'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
    <?php if (!function_exists('_7a81deb97bd931f33fdf128428414255')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/eye.blade.php', $__blaze->compiledPath.'/7a81deb97bd931f33fdf128428414255.php'); require $__blaze->compiledPath.'/7a81deb97bd931f33fdf128428414255.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'block [[data-viewable-open]>&]:hidden']); ?>
<?php _7a81deb97bd931f33fdf128428414255($__blaze, ['variant' => $iconVariant,'class' => 'block [[data-viewable-open]>&]:hidden'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
<?php $__slots9c85c2ca5108d2bb93efefdd6c4d188e['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots9c85c2ca5108d2bb93efefdd6c4d188e); ?>
<?php _9c85c2ca5108d2bb93efefdd6c4d188e($__blaze, $__attrs9c85c2ca5108d2bb93efefdd6c4d188e, $__slots9c85c2ca5108d2bb93efefdd6c4d188e, ['attributes', 'size'], ['xData' => 'x-data', 'xOn:click' => 'x-on:click', 'xBind:dataViewableOpen' => 'x-bind:data-viewable-open', 'ariaLabel' => 'aria-label'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack9c85c2ca5108d2bb93efefdd6c4d188e)) { $__slots9c85c2ca5108d2bb93efefdd6c4d188e = array_pop($__slotsStack9c85c2ca5108d2bb93efefdd6c4d188e); } ?>
<?php if (! empty($__attrsStack9c85c2ca5108d2bb93efefdd6c4d188e)) { $__attrs9c85c2ca5108d2bb93efefdd6c4d188e = array_pop($__attrsStack9c85c2ca5108d2bb93efefdd6c4d188e); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/input/viewable.blade.php ENDPATH**/ ?>