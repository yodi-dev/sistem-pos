<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="row mb-3">
            <div class="col-12 ">
                <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Edit Data Penjualan','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200']); ?>
                    <div class="flex">
                        <div class="w-1/2 mr-5">

                            <div>
                                <div class="label">
                                    <div class="label-text">Pembeli</div>
                                </div>

                                <select id="category" class="w-full text-base-content p-2 border rounded"
                                    wire:model="customer_id">
                                    <option>Pilih pembeli</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($transaction_id == $customer->id ? 'selected' : ''); ?>

                                            value="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>

                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['pembeli'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="label">
                                        <span class="label-text-alt"><?php echo e($message); ?></span>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Metode Pembayaran</div>
                                </div>
                                <select class="w-full text-base-content p-2 border rounded" wire:model="payment_method">
                                    <option <?php echo e($payment_method == 'tunai' ? 'selected' : ''); ?> value="tunai">Tunai
                                    </option>
                                    <option <?php echo e($payment_method == 'QRIS' ? 'selected' : ''); ?> value="QRIS">QRIS
                                    </option>
                                    <option <?php echo e($payment_method == 'utang' ? 'selected' : ''); ?> value="utang">Utang
                                    </option>
                                </select>

                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="label">
                                        <span class="label-text-alt"><?php echo e($message); ?></span>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Total Belanja</div>
                                </div>
                                <input type="text" wire:model.change="total_price"
                                    class="w-full text-black p-2 border rounded">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['total_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="label">
                                        <span class="label-text-alt"><?php echo e($message); ?></span>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Total Bayar</div>
                                </div>
                                <input type="text" wire:model.change="total_paid"
                                    class="w-full text-black p-2 border rounded">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['total_paid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="label">
                                        <span class="label-text-alt"><?php echo e($message); ?></span>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <div class="w-1/2">

                            <div>
                                <div class="label">
                                    <div class="label-text">Kembalian</div>
                                </div>
                                <input type="text" wire:model.change="change_due"
                                    class="w-full text-black p-2 border rounded">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['change_due'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="label">
                                        <span class="label-text-alt"><?php echo e($message); ?></span>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Utang</div>
                                </div>
                                <input type="text" wire:model.change="debt"
                                    class="w-full text-black p-2 border rounded">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['debt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="label">
                                        <span class="label-text-alt"><?php echo e($message); ?></span>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Status Utang</div>
                                </div>
                                <select class="w-full text-base-content p-2 border rounded" wire:model="debt_status">
                                    <option <?php echo e($payment_method == 'Lunas' ? 'selected' : ''); ?> value="Lunas">Lunas
                                    </option>
                                    <option <?php echo e($payment_method == 'Belum Lunas' ? 'selected' : ''); ?>

                                        value="Belum Lunas">Belum Lunas
                                    </option>
                                </select>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['debt_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="label">
                                        <span class="label-text-alt"><?php echo e($message); ?></span>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Tanggal</div>
                                </div>
                                <input type="date" wire:model="date" class="w-full text-black p-2 border rounded">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="label">
                                        <span class="label-text-alt"><?php echo e($message); ?></span>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                        </div>
                    </div>

                    <div class="flex mt-5">
                        <div class="w-1/2 mr-5">
                            <button wire:navigate href="<?php echo e(route('selling')); ?>"
                                class="btn btn-outline btn-error w-full text-center hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                                Kembali</button>
                        </div>
                        <div class="w-1/2">
                            <button wire:click="save"
                                class="btn w-full btn-neutral hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('#category').selectize({
                placeholder: 'Pilih pembeli...',
                allowEmptyOption: true,
            });
        });
    </script>

</div>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/transaction/update-sell.blade.php ENDPATH**/ ?>