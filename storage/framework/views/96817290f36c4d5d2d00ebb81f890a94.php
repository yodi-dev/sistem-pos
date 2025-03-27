<div>
    <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Laporan Harian','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200']); ?>
         <?php $__env->slot('menu', null, []); ?> 
            <button wire:click="printPdf" class="btn btn-sm btn-neutral text-base-100 rounded-md">Cetak</button>
         <?php $__env->endSlot(); ?>
        <table class="table table-auto w-full border-1 border-neutral shadow">
            <thead class="bg-neutral text-base-100 text-lg text-center">
                <tr>
                    <th class="border-r">Tanggal</th>
                    <th class="border-r">Pemasukkan</th>
                    <th class="border-r">Pengeluaran</th>
                    <th class="border-r">Tabungan</th>
                    <th class="border-r">Saldo QRIS</th>
                    <th class="border-r">Saldo</th>
                    <th class="border-r">Catatan</th>
                </tr>
            </thead>
            <tbody class="text-base-content">
                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($loop->odd ? 'bg-base-300' : 'bg-base-100'); ?>">
                        <td><?php echo e($report->formatted_report_date); ?></td>
                        <td>Rp. <?php echo e($report->formatted_total_income); ?></td>
                        <td>Rp. <?php echo e($report->formatted_total_outcome); ?></td>
                        <td>Rp. <?php echo e($report->formatted_savings); ?></td>
                        <td>Rp. <?php echo e($report->formatted_qris_balance); ?></td>
                        <td>Rp. <?php echo e($report->formatted_balance); ?></td>
                        <td><?php echo e($report->notes); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
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
</div><?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views\livewire\report\report-table.blade.php ENDPATH**/ ?>