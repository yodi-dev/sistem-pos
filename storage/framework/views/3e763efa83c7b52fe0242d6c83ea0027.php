 <main class="<?php echo \Illuminate\Support\Arr::toCssClasses(["w-full mx-auto", "max-w-screen-2xl" => !$fullWidth]); ?>">
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        "drawer lg:drawer-open",
        "drawer-end" => $sidebar?->attributes['right'],
        "max-sm:drawer-end" => $sidebar?->attributes['right-mobile'],
    ]); ?>">
        <input id="<?php echo e($sidebar?->attributes['drawer']); ?>" type="checkbox" class="drawer-toggle" />
        <div <?php echo e($content->attributes->class(["drawer-content w-full mx-auto p-5 lg:px-10 lg:py-5"])); ?>>
            <!-- MAIN CONTENT -->
            <?php echo e($content); ?>

        </div>

        <!-- SIDEBAR -->
        <?php if($sidebar): ?>
            <div
                x-data="{
                    collapsed: <?php echo e(session('mary-sidebar-collapsed', 'false')); ?>,
                    collapseText: '<?php echo e($collapseText); ?>',
                    toggle() {
                        this.collapsed = !this.collapsed;
                        fetch('<?php echo e($url); ?>?collapsed=' + this.collapsed);
                        this.$dispatch('sidebar-toggled', this.collapsed);
                    }
                }"

                @menu-sub-clicked="if(collapsed) { toggle() }"
                class="<?php echo \Illuminate\Support\Arr::toCssClasses(["drawer-side z-20 lg:z-auto", "top-0 lg:top-[73px] lg:h-[calc(100vh-73px)]" => $withNav]); ?>"
            >
                <label for="<?php echo e($sidebar?->attributes['drawer']); ?>" aria-label="close sidebar" class="drawer-overlay"></label>

                <!-- SIDEBAR CONTENT -->
                <div
                    :class="collapsed
                        ? '!w-[70px] [&>*_summary::after]:!hidden [&_.mary-hideable]:!hidden [&_.display-when-collapsed]:!block [&_.hidden-when-collapsed]:!hidden'
                        : '!w-[270px] [&>*_summary::after]:!block [&_.mary-hideable]:!block [&_.hidden-when-collapsed]:!block [&_.display-when-collapsed]:!hidden'"

                    <?php echo e($sidebar->attributes->class([
                            "flex flex-col !transition-all !duration-100 ease-out overflow-x-hidden overflow-y-auto h-screen",
                            "w-[70px] [&>*_summary::after]:hidden [&_.mary-hideable]:hidden [&_.display-when-collapsed]:block [&_.hidden-when-collapsed]:hidden" => session('mary-sidebar-collapsed') == 'true',
                            "w-[270px] [&>*_summary::after]:block [&_.mary-hideable]:block [&_.hidden-when-collapsed]:block [&_.display-when-collapsed]:hidden" => session('mary-sidebar-collapsed') != 'true',
                            "lg:h-[calc(100vh-73px)]" => $withNav
                        ])); ?>

                >
                    <div class="flex-1">
                        <?php echo e($sidebar); ?>

                    </div>

                     <!-- SIDEBAR COLLAPSE -->
                    <?php if($sidebar->attributes['collapsible']): ?>
                    <?php if (isset($component)) { $__componentOriginal5a2f10112e92a9c01ae3ba423b1cc044 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a2f10112e92a9c01ae3ba423b1cc044 = $attributes; } ?>
<?php $component = Mary\View\Components\Menu::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mary-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Menu::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'hidden !bg-inherit lg:block']); ?>
                        <?php if (isset($component)) { $__componentOriginal7c3255ff27a5c6d076ca64dbcfc1f879 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c3255ff27a5c6d076ca64dbcfc1f879 = $attributes; } ?>
<?php $component = Mary\View\Components\MenuItem::resolve(['icon' => ''.e($sidebar->attributes['collapse-icon'] ?? $collapseIcon).'','title' => ''.e($sidebar->attributes['collapse-text'] ?? $collapseText).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mary-menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\MenuItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'toggle']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c3255ff27a5c6d076ca64dbcfc1f879)): ?>
<?php $attributes = $__attributesOriginal7c3255ff27a5c6d076ca64dbcfc1f879; ?>
<?php unset($__attributesOriginal7c3255ff27a5c6d076ca64dbcfc1f879); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c3255ff27a5c6d076ca64dbcfc1f879)): ?>
<?php $component = $__componentOriginal7c3255ff27a5c6d076ca64dbcfc1f879; ?>
<?php unset($__componentOriginal7c3255ff27a5c6d076ca64dbcfc1f879); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a2f10112e92a9c01ae3ba423b1cc044)): ?>
<?php $attributes = $__attributesOriginal5a2f10112e92a9c01ae3ba423b1cc044; ?>
<?php unset($__attributesOriginal5a2f10112e92a9c01ae3ba423b1cc044); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a2f10112e92a9c01ae3ba423b1cc044)): ?>
<?php $component = $__componentOriginal5a2f10112e92a9c01ae3ba423b1cc044; ?>
<?php unset($__componentOriginal5a2f10112e92a9c01ae3ba423b1cc044); ?>
<?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- END SIDEBAR-->

    </div>
</main>

 <!-- FOOTER -->
 <?php if($footer): ?>
    <footer <?php echo e($footer?->attributes->class(["mx-auto w-full", "max-w-screen-2xl" => !$fullWidth ])); ?>>
        <?php echo e($footer); ?>

    </footer>
<?php endif; ?><?php /**PATH C:\Users\asus\Herd\sistem-pos\storage\framework\views/11690ed45149246be3ce2d4df04b63e3.blade.php ENDPATH**/ ?>