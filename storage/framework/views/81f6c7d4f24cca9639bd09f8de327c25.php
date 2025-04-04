<div>
    <?php if($isModal): ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('report.set-balance', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1131192526-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Laporan Sementara','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200']); ?>
         <?php $__env->slot('menu', null, []); ?> 
            <button wire:click="openModal" class="btn btn-sm btn-neutral text-base-100 rounded-md">Set Saldo</button>
         <?php $__env->endSlot(); ?>
        <div class="grid grid-cols-3 gap-4 text-base-content">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Pemasukkan QRIS</span>
                </div>
                <input type="text" wire:model="qrisIncome" class="input input-bordered w-full rounded-md" readonly />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Total Pemasukkan</span>
                </div>
                <input type="text"
                    x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                    wire:model.change="totalIncome" class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Total Pengeluaran</span>
                </div>
                <input type="text"
                    x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                    wire:model.change="totalOutcome" class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Tambah Tabungan</span>
                </div>
                <input type="text"
                    x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                    wire:model="addSavings" wire:change="setAddSavings"
                    class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full col-span-2">
                <div class="label">
                    <span class="label-text">Catatan</span>
                </div>
                <input type="text" wire:model="notes" class="input input-bordered w-full rounded-md" />
            </label>

        </div>

        <div class="divider"></div>

        <div class="grid grid-cols-2 text-base-content">
            <div class="text-center">
                <h4>Saldo</h4>
                <p class="text-base-content font-bold">Rp <?php echo e($balance); ?></p>
            </div>
            <div class="text-center">
                <h4>Tabungan</h4>
                <p class="text-base-content font-bold">Rp <?php echo e($savings); ?></p>
            </div>
        </div>

        <div>
            <button wire:click="generateReport" class="btn btn-neutral w-full text-base-100 mt-4 rounded-md">
                Simpan
            </button>
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
</div><?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views\livewire\report\temporary-report.blade.php ENDPATH**/ ?>