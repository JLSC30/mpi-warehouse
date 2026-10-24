<?php # [BlazeFolded]:{flux::breadcrumbs.item}:{C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/breadcrumbs/item.blade.php}:{1790619293} ?>
<?php # [BlazeFolded]:{flux::breadcrumbs.item}:{C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/breadcrumbs/item.blade.php}:{1790619293} ?>
<?php # [BlazeFolded]:{flux::breadcrumbs}:{C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/breadcrumbs/index.blade.php}:{1790619293} ?>
<?php # [BlazeFolded]:{flux::heading}:{C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/heading.blade.php}:{1790619293} ?>
<?php # [BlazeFolded]:{flux::text}:{C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/text.blade.php}:{1790619293} ?>
<?php # [BlazeFolded]:{flux::button}:{C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php}:{1790619293} ?>
<?php # [BlazeFolded]:{flux::button}:{C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php}:{1790619293} ?>
<?php
use Livewire\Component;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
?>

<div>
    <div class="flex flex-col gap-6">
        
        
        <?php ob_start(); ?><div class="flex" data-flux-breadcrumbs>
    <?php ob_start(); ?>
            <?php if (!function_exists('_772b20d8cac5832af3daa32a621ac508')) { $__blaze->compile('C:\Users\maintenance\Desktop\laravel\warehouse\vendor\livewire\flux\src/../stubs/resources/views/flux/breadcrumbs/item.blade.php', $__blaze->compiledPath.'/772b20d8cac5832af3daa32a621ac508.php'); require $__blaze->compiledPath.'/772b20d8cac5832af3daa32a621ac508.php'; } ?>
<?php if (isset($__slots772b20d8cac5832af3daa32a621ac508)) { $__slotsStack772b20d8cac5832af3daa32a621ac508[] = $__slots772b20d8cac5832af3daa32a621ac508; } ?>
<?php if (isset($__attrs772b20d8cac5832af3daa32a621ac508)) { $__attrsStack772b20d8cac5832af3daa32a621ac508[] = $__attrs772b20d8cac5832af3daa32a621ac508; } ?>
<?php $__attrs772b20d8cac5832af3daa32a621ac508 = ['href' => route('categories.index'),'wire:navigate' => true]; ?>
<?php $__slots772b20d8cac5832af3daa32a621ac508 = []; ?>
<?php $__blaze->pushData($__attrs772b20d8cac5832af3daa32a621ac508); ?>
<?php ob_start(); ?>
                <?php echo e(__('Category')); ?>

            <?php $__slots772b20d8cac5832af3daa32a621ac508['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots772b20d8cac5832af3daa32a621ac508); ?>
<?php _772b20d8cac5832af3daa32a621ac508($__blaze, $__attrs772b20d8cac5832af3daa32a621ac508, $__slots772b20d8cac5832af3daa32a621ac508, ['href', 'wire:navigate'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack772b20d8cac5832af3daa32a621ac508)) { $__slots772b20d8cac5832af3daa32a621ac508 = array_pop($__slotsStack772b20d8cac5832af3daa32a621ac508); } ?>
<?php if (! empty($__attrsStack772b20d8cac5832af3daa32a621ac508)) { $__attrs772b20d8cac5832af3daa32a621ac508 = array_pop($__attrsStack772b20d8cac5832af3daa32a621ac508); } ?>
<?php $__blaze->popData(); ?>
            <?php ob_start(); ?><div class="flex items-center text-sm font-medium group/breadcrumb" data-flux-breadcrumbs-item>
            <div class="text-gray-500 dark:text-white/80">
                            <?php ob_start(); ?>
                <?php echo e($form->category->name); ?>

            <?php echo trim(ob_get_clean()); ?>

                    </div>
    
            <svg class="shrink-0 [:where(&amp;)]:size-5 mx-1 text-zinc-300 dark:text-white/80 group-last/breadcrumb:hidden rtl:hidden" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
</svg>

                <svg class="shrink-0 [:where(&amp;)]:size-5 mx-1 text-zinc-300 dark:text-white/80 group-last/breadcrumb:hidden hidden rtl:inline" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/>
</svg>

            </div>
<?php echo ltrim(ob_get_clean()); ?>
            <?php ob_start(); ?><div class="flex items-center text-sm font-medium group/breadcrumb" data-flux-breadcrumbs-item>
            <div class="text-gray-500 dark:text-white/80">
                            <?php ob_start(); ?>
                <?php echo e(__('Edit')); ?>

            <?php echo trim(ob_get_clean()); ?>

                    </div>
    
            <svg class="shrink-0 [:where(&amp;)]:size-5 mx-1 text-zinc-300 dark:text-white/80 group-last/breadcrumb:hidden rtl:hidden" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
</svg>

                <svg class="shrink-0 [:where(&amp;)]:size-5 mx-1 text-zinc-300 dark:text-white/80 group-last/breadcrumb:hidden hidden rtl:inline" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/>
</svg>

            </div>
<?php echo ltrim(ob_get_clean()); ?>
        <?php echo trim(ob_get_clean()); ?>

</div>
<?php echo ltrim(ob_get_clean()); ?>

        <?php ob_start(); ?><h1 class="font-medium [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white text-2xl [&amp;:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&amp;]:mt-2 mb-6" data-flux-heading><?php ob_start(); ?><?php echo e(__('Edit :name', ['name' => $form->category->name])); ?><?php echo trim(ob_get_clean()); ?></h1>

        <?php echo ltrim(ob_get_clean()); ?>

        <form wire:submit="save" class="space-y-6">
        <?php echo $__env->make('pages.category.partials.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-6 dark:border-zinc-700">
            <?php ob_start(); ?><p class="[:where(&amp;)]:font-normal [:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-500 [:where(&amp;)]:dark:text-white/70 me-auto" wire:dirty="" wire:target="form" data-flux-text ><?php ob_start(); ?><?php echo e(__('You have unsaved changes.')); ?><?php echo trim(ob_get_clean()); ?></p><?php echo ltrim(ob_get_clean()); ?>
            <?php ob_start(); ?><a href="<?php echo e(route('categories.index')); ?>" data-flux-button="data-flux-button" class="relative items-center font-medium justify-center whitespace-nowrap disabled:opacity-50 dark:disabled:opacity-50 disabled:cursor-default disabled:pointer-events-none disabled:shadow-none justify-center h-10 text-sm rounded-lg gap-2 ps-4 pe-4 inline-flex  bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15 text-zinc-800 dark:text-white" wire:navigate="">
        <?php ob_start(); ?><?php echo e(__('Cancel')); ?><?php echo trim(ob_get_clean()); ?>

    </a>
<?php echo ltrim(ob_get_clean()); ?>
            <?php ob_start(); ?><button type="submit" class="relative items-center font-medium justify-center whitespace-nowrap disabled:opacity-50 dark:disabled:opacity-50 disabled:cursor-default disabled:pointer-events-none disabled:shadow-none justify-center h-10 text-sm rounded-lg gap-2 ps-4 pe-4 inline-flex  bg-[var(--color-accent)] hover:bg-[color-mix(in_oklab,_var(--color-accent),_transparent_10%)] text-[var(--color-accent-foreground)] border border-black/10 dark:border-0 shadow-[inset_0px_1px_--theme(--color-white/.2)] [[data-flux-button-group]_&amp;]:border-e-0 [:is([data-flux-button-group]&gt;&amp;:last-child,_[data-flux-button-group]_:last-child&gt;&amp;)]:border-e-[1px] dark:[:is([data-flux-button-group]&gt;&amp;:last-child,_[data-flux-button-group]_:last-child&gt;&amp;)]:border-e-0 [:is([data-flux-button-group]&gt;&amp;:not(:first-child),_[data-flux-button-group]_:not(:first-child)&gt;&amp;)]:border-s-[1px]! [:is([data-flux-button-group]&gt;&amp;:not(:first-child),_[data-flux-button-group]_:not(:first-child)&gt;&amp;)]:border-s-[color-mix(in_srgb,var(--color-accent-foreground),transparent_85%)] *:transition-opacity [&amp;[disabled]&gt;:not([data-flux-loading-indicator])]:opacity-0 [&amp;[disabled]&gt;[data-flux-loading-indicator]]:opacity-100 [&amp;[disabled]]:pointer-events-none" data-flux-button="data-flux-button" data-flux-group-target="data-flux-group-target">
        <div class="absolute inset-0 flex items-center justify-center opacity-0" data-flux-loading-indicator>
                <svg class="shrink-0 [:where(&amp;)]:size-4 animate-spin" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" data-slot="icon">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
</svg>
                    </div>
        
        
                    
            
            <span><?php ob_start(); ?><?php echo e(__('Update category')); ?><?php echo trim(ob_get_clean()); ?></span>
    </button>
<?php echo ltrim(ob_get_clean()); ?>
        </div>

    </form>
    </div>
</div><?php /**PATH C:\Users\maintenance\Desktop\laravel\warehouse\storage\framework\views/livewire/views/c1b24efc.blade.php ENDPATH**/ ?>