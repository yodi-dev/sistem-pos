<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 mb-4 text-center sm:mt-0  sm:text-left">
                    <h2 class="text-2xl leading-6 font-medium text-neutral" id="modal-title">
                        <?php echo e('Pilih Supplier'); ?>

                    </h2>
                    <div class="mt-2 text-base-content">
                        <form>
                            <div class="mt-4">
                                <label for="selectedSupplier">Supplier</label>
                                <select wire:change="updateSelectedSupplier" wire:model="selectedSupplier"
                                    class="select select-bordered select-sm w-fit text-base-content rounded-md">
                                    <option selected value="">Supplier</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $chooseSuppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedSupplier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-red-500"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/dashboard/choose-supplier.blade.php ENDPATH**/ ?>