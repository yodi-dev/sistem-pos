<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <?php if(session('success')): ?>
            <div role="alert" class="alert mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>
        <div class="row mb-3">
            <div class="col-12 ">
                <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Kelola Unit - '.e($product->name).'','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200']); ?>
                    <div class="grid grid-cols-2 gap-4 mt-3">
                        <div class="border shadow p-3 flex flex-col h-full text-base-content">
                            <h3 class="text-lg font-semibold text-base-content dark:text-base-100 text-center mb-3">
                                Tambah</h3>

                            <div class="mb-3">
                                <label>Nama Satuan</label>
                                <input type="text" wire:model.debounce.500ms="unit_name"
                                    class="form-control w-full p-2 border rounded">
                            </div>

                            <div class="mb-3">
                                <label>Jumlah per Unit</label>
                                <input type="number" wire:model.debounce.500ms="multiplier"
                                    class="form-control w-full p-2 border rounded">
                            </div>

                            <!-- Tombol untuk Otomatis Mengisi Field -->
                            <div class="flex mb-5 flex-grow">
                                <button wire:click="fillDefaultValues('PCS', 1)"
                                    class="btn btn-xs btn-neutral mr-2 rounded-md text-base-100">PCS</button>
                                <button wire:click="fillDefaultValues('BKS', 1)"
                                    class="btn btn-xs btn-neutral mr-2 rounded-md text-base-100">BKS</button>
                                <button wire:click="fillDefaultValues('Renteng (10)', 10)"
                                    class="btn btn-xs btn-neutral mr-2 rounded-md text-base-100">Renteng
                                    (10)</button>
                                <button wire:click="fillDefaultValues('Renteng (12) ', 12)"
                                    class="btn btn-xs btn-neutral rounded-md text-base-100">Renteng
                                    (12)</button>
                            </div>
                            <button wire:click="saveUnit"
                                class="btn btn-sm btn-neutral btn-block text-base-100 rounded-md">Simpan</button>


                        </div>

                        <div class="border shadow p-3 flex flex-col h-full">
                            <h3 class="text-lg font-semibold text-base-content dark:text-base-100 text-center mb-3">Data
                            </h3>
                            <div class="mb-3 flex-grow">
                                <table class="table table-auto w-full border-1 border-neutral shadow">
                                    <thead class="bg-neutral text-base-100 text-lg text-center">
                                        <tr>
                                            <th class="border-r">Nama</th>
                                            <th class="border-r">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-base-content">
                                        <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr :key="$item - > id"
                                                class="<?php echo e($loop->odd ? 'bg-base-300' : 'bg-base-100'); ?>">
                                                <td><?php echo e($item->name); ?></td>
                                                <td class="flex justify-center"><?php echo e($item->multiplier); ?>

                                                    <button wire:click="deleteUnit(<?php echo e($item->id); ?>)">
                                                        <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => 's-trash'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-error ml-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce0070e6ae017cca68172d0230e44821)): ?>
<?php $attributes = $__attributesOriginalce0070e6ae017cca68172d0230e44821; ?>
<?php unset($__attributesOriginalce0070e6ae017cca68172d0230e44821); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce0070e6ae017cca68172d0230e44821)): ?>
<?php $component = $__componentOriginalce0070e6ae017cca68172d0230e44821; ?>
<?php unset($__componentOriginalce0070e6ae017cca68172d0230e44821); ?>
<?php endif; ?>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>
                            </div>
                            <a wire:navigate href="<?php echo e(route('products')); ?>"
                                class="btn btn-sm btn-outline btn-error btn-block text-base-100 rounded-md">Tutup</a>
                        </div>
                    </div>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f194736b6f6432dc38786f292496c34)): ?>
<?php $attributes = $__attributesOriginal7f194736b6f6432dc38786f292496c34; ?>
<?php unset($__attributesOriginal7f194736b6f6432dc38786f292496c34); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f194736b6f6432dc38786f292496c34)): ?>
<?php $component = $__componentOriginal7f194736b6f6432dc38786f292496c34; ?>
<?php unset($__componentOriginal7f194736b6f6432dc38786f292496c34); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views\livewire\product\unit-manager.blade.php ENDPATH**/ ?>