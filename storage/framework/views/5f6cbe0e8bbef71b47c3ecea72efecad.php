<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex z-20 items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>

            <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Saldo & Tabungan Awal','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200']); ?>
                <div class="grid grid-cols-2 gap-4 text-base-content">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Set Saldo Awal</span>
                        </div>
                        <input type="text" x-on:change="$wire.$refresh()"
                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                            id="opening_balance" wire:model="openingBalance" wire:change="setOpeningBalance"
                            class="input input-bordered w-full rounded-md">
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Set Tabungan Awal</span>
                        </div>
                        <input type="text"
                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                            id="opening_savings" wire:model="openingSavings" wire:change="setOpeningSavings"
                            class="input input-bordered w-full rounded-md">
                    </label>
                </div>

                <div class="divider"></div>

                <div class="grid grid-cols-2 text-base-content">
                    <div class="text-center">
                        <h4>Saldo Awal</h4>
                        <p class="text-base-content font-bold">Rp <?php echo e($openingBalance); ?></p>
                    </div>
                    <div class="text-center">
                        <h4>Tabungan Awal</h4>
                        <p class="text-base-content font-bold">Rp <?php echo e($openingSavings); ?></p>
                    </div>
                </div>

                <div class="divider"></div>

                <div>
                    <button wire:click="closeModal()"
                        class="btn btn-outline btn-error text-base-100 rounded dark:bg-info dark:hover:bg-green-700 w-full">
                        Kembali</button>
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
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/report/set-balance.blade.php ENDPATH**/ ?>