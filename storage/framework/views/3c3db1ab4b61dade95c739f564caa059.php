<div>
    <!--[if BLOCK]><![endif]--><?php if($expenses->isEmpty()): ?>
        <p class="text-center text-gray-500">Belum ada Pengeluaran.</p>
    <?php else: ?>
        <table class="table w-full border-1 border-neutral shadow">
            <thead class="bg-neutral text-base-100 text-lg text-center">
                <tr>
                    <th class="w-2/5 border-r">Tanggal</th>
                    <th class="w-2/5 border-r">Pengeluaran</th>
                    <th class="w-2/5 border-r">Nominal</th>
                    <th class="w-2/5 border-r">Catatan</th>
                    <th class="w-1/5 border-r">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-base-content">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($loop->odd ? 'bg-base-300' : 'bg-base-100'); ?>">
                        <td><?php echo e($expense->formatted_date); ?></td>
                        <td><?php echo e($expense->expense); ?></td>
                        <td>Rp. <?php echo e(number_format($expense->amount, 0, ',', '.')); ?></td>
                        <td><?php echo e($expense->note); ?></td>
                        <td class="flex justify-center">
                            <button wire:click="edit(<?php echo e($expense->id); ?>)"
                                class="px-2 text-sm text-neutral dark:text-blue-400 border-neutral">
                                <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => 'm-pencil-square'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                            <button wire:click="delete(<?php echo e($expense->id); ?>)"
                                class="px-2 text-sm text-neutral dark:text-red-400 border-l border-neutral">
                                <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => 's-trash'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            <?php echo e($expenses->links()); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/expense/expense-table.blade.php ENDPATH**/ ?>