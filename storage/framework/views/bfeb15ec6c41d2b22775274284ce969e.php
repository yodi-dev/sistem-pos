<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="row mb-3">
            <div class="col-12 ">

                <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => ''.e($isEditing ? 'Edit Produk' : 'Tambah Produk').'','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                    <div class="label-text">Kode Produk</div>
                                </div>
                                <input type="text" wire:model="code" class="w-full text-black p-2 border rounded">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['code'];
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
                                    <div class="label-text">Nama produk</div>
                                </div>
                                <input type="text" wire:model="name" class="w-full text-black p-2 border rounded">
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Kategori</div>
                                </div>
                                <select id="category" class="w-full text-black p-2 border rounded"
                                    wire:model="category_id">
                                    <option>Pilih kategori</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($category->id == $category_id ? 'selected' : ''); ?>

                                            value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Harga Beli</div>
                                </div>
                                <input type="number" wire:model.change="purchase_price"
                                    class="w-full text-black p-2 border rounded">
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Harga Ecer</div>
                                </div>
                                <input type="text" wire:model.change="retail_price"
                                    class="w-full text-black p-2 border rounded">
                            </div>
                        </div>

                        <div class="w-1/2">
                            <div>
                                <div class="label">
                                    <div class="label-text">Harga Grosir</div>
                                </div>
                                <input type="text" wire:model.change="wholesale_price"
                                    class="w-full text-black p-2 border rounded">
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Harga Reseller</div>
                                </div>
                                <input type="text" wire:model.change="reseller_price"
                                    class="w-full text-black p-2 border rounded">
                            </div>
                            <div>
                                <div class="label">
                                    <div class="label-text">Harga Agen</div>
                                </div>
                                <input type="text" wire:model.change="agent_price"
                                    class="w-full text-black p-2 border rounded">
                            </div>
                            <div>
                                <div class="label">
                                    <div class="label-text">Stok</div>
                                </div>
                                <input type="text" wire:model="stock" class="w-full text-black p-2 border rounded">
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Lokasi</div>
                                </div>
                                <input type="text" wire:model="location"
                                    class="w-full text-black p-2 border rounded">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="flex space-x-2 w-full">
                            <button wire:navigate href="<?php echo e(route('products')); ?>"
                                class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                                Kembali</button>
                            <button wire:click="save"
                                class="btn w-1/2 bg-neutral hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
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
</div>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/product/create-product.blade.php ENDPATH**/ ?>