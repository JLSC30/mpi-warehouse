<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'sidebar' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'sidebar' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sidebar): ?>
    <?php if (!function_exists('_5f7c2fda7aed44f908c7308f531c39ef')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/brand.blade.php', $__blaze->compiledPath.'/5f7c2fda7aed44f908c7308f531c39ef.php'); require $__blaze->compiledPath.'/5f7c2fda7aed44f908c7308f531c39ef.php'; } ?>
<?php if (isset($__slots5f7c2fda7aed44f908c7308f531c39ef)) { $__slotsStack5f7c2fda7aed44f908c7308f531c39ef[] = $__slots5f7c2fda7aed44f908c7308f531c39ef; } ?>
<?php if (isset($__attrs5f7c2fda7aed44f908c7308f531c39ef)) { $__attrsStack5f7c2fda7aed44f908c7308f531c39ef[] = $__attrs5f7c2fda7aed44f908c7308f531c39ef; } ?>
<?php $__attrs5f7c2fda7aed44f908c7308f531c39ef = ['name' => config('app.name', 'Laravel'),'attributes' => $attributes]; ?>
<?php $__slots5f7c2fda7aed44f908c7308f531c39ef = []; ?>
<?php $__blaze->pushData($__attrs5f7c2fda7aed44f908c7308f531c39ef); ?>
<?php ob_start(); ?>
         <?php ob_start(); ?>
            <?php if (isset($component)) { $__componentOriginal159d6670770cb479b1921cea6416c26c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159d6670770cb479b1921cea6416c26c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo-icon','data' => ['class' => 'size-5 fill-current text-white dark:text-black']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 fill-current text-white dark:text-black']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $attributes = $__attributesOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__attributesOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $component = $__componentOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__componentOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
        <?php $__slots5f7c2fda7aed44f908c7308f531c39ef['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground']); ?>
    <?php $__slots5f7c2fda7aed44f908c7308f531c39ef['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots5f7c2fda7aed44f908c7308f531c39ef); ?>
<?php _5f7c2fda7aed44f908c7308f531c39ef($__blaze, $__attrs5f7c2fda7aed44f908c7308f531c39ef, $__slots5f7c2fda7aed44f908c7308f531c39ef, ['name', 'attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack5f7c2fda7aed44f908c7308f531c39ef)) { $__slots5f7c2fda7aed44f908c7308f531c39ef = array_pop($__slotsStack5f7c2fda7aed44f908c7308f531c39ef); } ?>
<?php if (! empty($__attrsStack5f7c2fda7aed44f908c7308f531c39ef)) { $__attrs5f7c2fda7aed44f908c7308f531c39ef = array_pop($__attrsStack5f7c2fda7aed44f908c7308f531c39ef); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php if (!function_exists('_b49ad793148ed7f1e0a14561a6aed912')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/brand.blade.php', $__blaze->compiledPath.'/b49ad793148ed7f1e0a14561a6aed912.php'); require $__blaze->compiledPath.'/b49ad793148ed7f1e0a14561a6aed912.php'; } ?>
<?php if (isset($__slotsb49ad793148ed7f1e0a14561a6aed912)) { $__slotsStackb49ad793148ed7f1e0a14561a6aed912[] = $__slotsb49ad793148ed7f1e0a14561a6aed912; } ?>
<?php if (isset($__attrsb49ad793148ed7f1e0a14561a6aed912)) { $__attrsStackb49ad793148ed7f1e0a14561a6aed912[] = $__attrsb49ad793148ed7f1e0a14561a6aed912; } ?>
<?php $__attrsb49ad793148ed7f1e0a14561a6aed912 = ['name' => config('app.name', 'Laravel'),'attributes' => $attributes]; ?>
<?php $__slotsb49ad793148ed7f1e0a14561a6aed912 = []; ?>
<?php $__blaze->pushData($__attrsb49ad793148ed7f1e0a14561a6aed912); ?>
<?php ob_start(); ?>
         <?php ob_start(); ?>
            <?php if (isset($component)) { $__componentOriginal159d6670770cb479b1921cea6416c26c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159d6670770cb479b1921cea6416c26c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo-icon','data' => ['class' => 'size-5 fill-current text-white dark:text-black']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 fill-current text-white dark:text-black']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $attributes = $__attributesOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__attributesOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $component = $__componentOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__componentOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
        <?php $__slotsb49ad793148ed7f1e0a14561a6aed912['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground']); ?>
    <?php $__slotsb49ad793148ed7f1e0a14561a6aed912['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsb49ad793148ed7f1e0a14561a6aed912); ?>
<?php _b49ad793148ed7f1e0a14561a6aed912($__blaze, $__attrsb49ad793148ed7f1e0a14561a6aed912, $__slotsb49ad793148ed7f1e0a14561a6aed912, ['name', 'attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb49ad793148ed7f1e0a14561a6aed912)) { $__slotsb49ad793148ed7f1e0a14561a6aed912 = array_pop($__slotsStackb49ad793148ed7f1e0a14561a6aed912); } ?>
<?php if (! empty($__attrsStackb49ad793148ed7f1e0a14561a6aed912)) { $__attrsb49ad793148ed7f1e0a14561a6aed912 = array_pop($__attrsStackb49ad793148ed7f1e0a14561a6aed912); } ?>
<?php $__blaze->popData(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\Users\maintenance\Desktop\laravel\warehouse\resources\views/components/app-logo.blade.php ENDPATH**/ ?>