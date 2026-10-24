<?php
if (!function_exists('__65d8c7239a5177e05ab8cd60d31e4ffe')):
function __65d8c7239a5177e05ab8cd60d31e4ffe($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'length' => null,
    'private' => false,
];
$length ??= $attributes['length'] ?? $__defaults['length']; unset($attributes['length']);
$private ??= $attributes['private'] ?? $__defaults['private']; unset($attributes['private']);
unset($__defaults);
?>

<?php
    $classes = Flux::classes()
        ->add('flex items-center gap-2 isolate w-fit')
        ->add('[&_[data-flux-input-group]]:w-auto')
?>

<?php if (!function_exists('__db89d604b9914dfe5417896a5a5f6dd9')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php', $__blaze->compiledPath.'/db89d604b9914dfe5417896a5a5f6dd9.php'); require $__blaze->compiledPath.'/db89d604b9914dfe5417896a5a5f6dd9.php'; } ?>
<?php if (isset($__slotsdb89d604b9914dfe5417896a5a5f6dd9)) { $__slotsStackdb89d604b9914dfe5417896a5a5f6dd9[] = $__slotsdb89d604b9914dfe5417896a5a5f6dd9; } ?>
<?php if (isset($__attrsdb89d604b9914dfe5417896a5a5f6dd9)) { $__attrsStackdb89d604b9914dfe5417896a5a5f6dd9[] = $__attrsdb89d604b9914dfe5417896a5a5f6dd9; } ?>
<?php $__attrsdb89d604b9914dfe5417896a5a5f6dd9 = ['attributes' => $attributes]; ?>
<?php $__slotsdb89d604b9914dfe5417896a5a5f6dd9 = []; ?>
<?php $__blaze->pushData($__attrsdb89d604b9914dfe5417896a5a5f6dd9); ?>
<?php ob_start(); ?>
    <ui-otp
        <?php echo e($attributes->class($classes)); ?>

        data-flux-otp
        data-flux-control
        role="group"
        data-flux-input-aria-label="<?php echo e(__('Character {current} of {total}')); ?>"
    >
        <?php if($slot->isEmpty() && $length): ?>
            <?php for($i = 0; $i < $length; $i++): ?>
                <?php if (!function_exists('__fba2648ea6011cf255a5dd426fe34940')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/otp/input.blade.php', $__blaze->compiledPath.'/fba2648ea6011cf255a5dd426fe34940.php'); require $__blaze->compiledPath.'/fba2648ea6011cf255a5dd426fe34940.php'; } ?>
<?php $__blaze->pushData([]); ?>
<?php __fba2648ea6011cf255a5dd426fe34940($__blaze, [], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
            <?php endfor; ?>
        <?php else: ?>
            <?php echo e($slot); ?>

        <?php endif; ?>
    </ui-otp>
<?php $__slotsdb89d604b9914dfe5417896a5a5f6dd9['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsdb89d604b9914dfe5417896a5a5f6dd9); ?>
<?php __db89d604b9914dfe5417896a5a5f6dd9($__blaze, $__attrsdb89d604b9914dfe5417896a5a5f6dd9, $__slotsdb89d604b9914dfe5417896a5a5f6dd9, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackdb89d604b9914dfe5417896a5a5f6dd9)) { $__slotsdb89d604b9914dfe5417896a5a5f6dd9 = array_pop($__slotsStackdb89d604b9914dfe5417896a5a5f6dd9); } ?>
<?php if (! empty($__attrsStackdb89d604b9914dfe5417896a5a5f6dd9)) { $__attrsdb89d604b9914dfe5417896a5a5f6dd9 = array_pop($__attrsStackdb89d604b9914dfe5417896a5a5f6dd9); } ?>
<?php $__blaze->popData(); ?><?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/otp/index.blade.php ENDPATH**/ ?>