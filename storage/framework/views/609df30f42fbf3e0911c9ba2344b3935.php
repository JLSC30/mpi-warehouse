<?php
if (!function_exists('_609df30f42fbf3e0911c9ba2344b3935')):
function _609df30f42fbf3e0911c9ba2344b3935($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
$__defaults = [
    'interactive' => null,
    'position' => 'top',
    'align' => 'center',
    'content' => null,
    'kbd' => null,
    'toggleable' => null,
];
$interactive ??= $attributes['interactive'] ?? $__defaults['interactive']; unset($attributes['interactive']);
$position ??= $attributes['position'] ?? $__defaults['position']; unset($attributes['position']);
$align ??= $attributes['align'] ?? $__defaults['align']; unset($attributes['align']);
$content ??= $attributes['content'] ?? $__defaults['content']; unset($attributes['content']);
$kbd ??= $attributes['kbd'] ?? $__defaults['kbd']; unset($attributes['kbd']);
$toggleable ??= $attributes['toggleable'] ?? $__defaults['toggleable']; unset($attributes['toggleable']);
unset($__defaults);
?>

<?php
// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}
?>

<?php if ($toggleable): ?>
    <ui-dropdown position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php if (!function_exists('_ba4e69335d131af0e5cb3f8d3cb7c358')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/ba4e69335d131af0e5cb3f8d3cb7c358.php'); require $__blaze->compiledPath.'/ba4e69335d131af0e5cb3f8d3cb7c358.php'; } ?>
<?php if (isset($__slotsba4e69335d131af0e5cb3f8d3cb7c358)) { $__slotsStackba4e69335d131af0e5cb3f8d3cb7c358[] = $__slotsba4e69335d131af0e5cb3f8d3cb7c358; } ?>
<?php if (isset($__attrsba4e69335d131af0e5cb3f8d3cb7c358)) { $__attrsStackba4e69335d131af0e5cb3f8d3cb7c358[] = $__attrsba4e69335d131af0e5cb3f8d3cb7c358; } ?>
<?php $__attrsba4e69335d131af0e5cb3f8d3cb7c358 = ['kbd' => $kbd]; ?>
<?php $__slotsba4e69335d131af0e5cb3f8d3cb7c358 = []; ?>
<?php $__blaze->pushData($__attrsba4e69335d131af0e5cb3f8d3cb7c358); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slotsba4e69335d131af0e5cb3f8d3cb7c358['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsba4e69335d131af0e5cb3f8d3cb7c358); ?>
<?php _ba4e69335d131af0e5cb3f8d3cb7c358($__blaze, $__attrsba4e69335d131af0e5cb3f8d3cb7c358, $__slotsba4e69335d131af0e5cb3f8d3cb7c358, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackba4e69335d131af0e5cb3f8d3cb7c358)) { $__slotsba4e69335d131af0e5cb3f8d3cb7c358 = array_pop($__slotsStackba4e69335d131af0e5cb3f8d3cb7c358); } ?>
<?php if (! empty($__attrsStackba4e69335d131af0e5cb3f8d3cb7c358)) { $__attrsba4e69335d131af0e5cb3f8d3cb7c358 = array_pop($__attrsStackba4e69335d131af0e5cb3f8d3cb7c358); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-dropdown>
<?php else: ?>
    <ui-tooltip position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip <?php if($interactive): ?> interactive <?php endif; ?>>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php if (!function_exists('_ba4e69335d131af0e5cb3f8d3cb7c358')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/ba4e69335d131af0e5cb3f8d3cb7c358.php'); require $__blaze->compiledPath.'/ba4e69335d131af0e5cb3f8d3cb7c358.php'; } ?>
<?php if (isset($__slotsba4e69335d131af0e5cb3f8d3cb7c358)) { $__slotsStackba4e69335d131af0e5cb3f8d3cb7c358[] = $__slotsba4e69335d131af0e5cb3f8d3cb7c358; } ?>
<?php if (isset($__attrsba4e69335d131af0e5cb3f8d3cb7c358)) { $__attrsStackba4e69335d131af0e5cb3f8d3cb7c358[] = $__attrsba4e69335d131af0e5cb3f8d3cb7c358; } ?>
<?php $__attrsba4e69335d131af0e5cb3f8d3cb7c358 = ['kbd' => $kbd]; ?>
<?php $__slotsba4e69335d131af0e5cb3f8d3cb7c358 = []; ?>
<?php $__blaze->pushData($__attrsba4e69335d131af0e5cb3f8d3cb7c358); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slotsba4e69335d131af0e5cb3f8d3cb7c358['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsba4e69335d131af0e5cb3f8d3cb7c358); ?>
<?php _ba4e69335d131af0e5cb3f8d3cb7c358($__blaze, $__attrsba4e69335d131af0e5cb3f8d3cb7c358, $__slotsba4e69335d131af0e5cb3f8d3cb7c358, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackba4e69335d131af0e5cb3f8d3cb7c358)) { $__slotsba4e69335d131af0e5cb3f8d3cb7c358 = array_pop($__slotsStackba4e69335d131af0e5cb3f8d3cb7c358); } ?>
<?php if (! empty($__attrsStackba4e69335d131af0e5cb3f8d3cb7c358)) { $__attrsba4e69335d131af0e5cb3f8d3cb7c358 = array_pop($__attrsStackba4e69335d131af0e5cb3f8d3cb7c358); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-tooltip>
<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php ENDPATH**/ ?>