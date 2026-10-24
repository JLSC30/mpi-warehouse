<?php
if (!function_exists('__fba2648ea6011cf255a5dd426fe34940')):
function __fba2648ea6011cf255a5dd426fe34940($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
$__awareDefaults = ['mode' => 'numeric', 'private' => false];
$mode = $__blaze->getConsumableData('mode', $__awareDefaults['mode']);
$private = $__blaze->getConsumableData('private', $__awareDefaults['private']);
unset($__awareDefaults);
?>

<?php
    $attributes = $attributes
        ->merge([
            'class' => 'w-8! grow-0 has-focus-within:z-10',
            'class:input' => 'px-0! py-3 text-center disabled:opacity-75 disabled:shadow-xs! dark:disabled:shadow-none!',
        ])
        ->merge(['data-flux-otp-input' => ''])
    ;

    if ($mode == 'numeric') {
        $attributes = $attributes->merge(['inputmode' => 'numeric']);
    }

    if ($private) {
        $attributes = $attributes->merge(['type' => 'password']);
    }
?>

<?php if (!function_exists('__9d220ac1d47cab2c0fba099f02379ad4')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/input/index.blade.php', $__blaze->compiledPath.'/9d220ac1d47cab2c0fba099f02379ad4.php'); require $__blaze->compiledPath.'/9d220ac1d47cab2c0fba099f02379ad4.php'; } ?>
<?php $__blaze->pushData(['attributes' => $attributes]); ?>
<?php __9d220ac1d47cab2c0fba099f02379ad4($__blaze, ['attributes' => $attributes], [], ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/otp/input.blade.php ENDPATH**/ ?>