<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex z-20 items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>
            <div class="bg-base-200 dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="bg-base-100 text-base-content shadow rounded-lg p-6 mb-5 max-h-[300px] overflow-y-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Kulakan</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Supplier</p>
                            <p class="text-md font-semibold"><?php echo e($selectedWholesale->supplier->name); ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Tanggal</p>
                            <p class="text-md font-semibold"><?php echo e($selectedWholesale->formatted_date); ?></p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <p class="text-sm text-gray-600 font-medium mb-2">Detail Barang</p>
                        <ul class="divide-y divide-gray-200">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $selectedWholesale->wholesaleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-2 flex justify-between">
                                    <p class="font-medium"><?php echo e($item->product->name); ?></p>
                                    <p>
                                        <?php echo e($item->quantity); ?> <?php echo e($item->unit); ?>

                                    </p>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </ul>
                    </div>
                </div>

                <div class="flex space-x-2 w-full">
                    <button wire:click="closeModal()"
                        class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                        Kembali</button>
                    <button wire:click="printWholesale(<?php echo e($selectedWholesale->id); ?>)"
                        class="btn w-1/2 bg-neutral hover:bg-base-100 text-base-100 hover:text-neutral rounded dark:bg-info dark:hover:bg-green-700">
                        Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/wholesale/detail.blade.php ENDPATH**/ ?>