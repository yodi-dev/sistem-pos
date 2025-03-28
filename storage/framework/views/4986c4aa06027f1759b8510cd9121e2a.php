<div class="text-base-content dark:text-gray-100">
    <div class="mx-auto sm:px-6 lg:px-0">

        <div class="row mb-3">
            <div class="col-12 ">
                <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Barang Masuk','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200']); ?>
                    <div class="flex justify-center">
                        <div class="w-full relative">
                            <div x-data="{
                                focusSearch() { $refs.searchInput.focus(); }
                            }" x-init="$refs.searchInput.focus()"
                                @keydown.window.prevent.ctrl.k="focusSearch()" class="w-full">
                                <input type="text" wire:model.live="search" placeholder="Cari barang..."
                                    class="input input-bordered text-base-content w-full rounded-md"
                                    wire:keydown.arrow-down="selectNext" wire:keydown.arrow-up="selectPrevious"
                                    wire:keydown.enter="confirmSelection" x-ref="searchInput" />
                            </div>
                            <!-- Dropdown Hasil Pencarian -->
                            <?php if(!empty($products)): ?>
                                <ul
                                    class="absolute bg-white text-base-content max-h-80 overflow-y-scroll w-full rounded-md shadow-md z-10">
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li wire:click="addToCart(<?php echo e($product->id); ?>)"
                                            class="flex justify-between items-center py-2 px-4 cursor-pointer hover:bg-gray-200
                    <?php echo e($highlightIndex === $index ? 'bg-gray-200' : ''); ?>">
                                            <span><?php echo e($product->name); ?></span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
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

        <div class="bg-base-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div>
                    <input type="text" id="searchSupplier" wire:model.live="searchSupplier"
                        wire:keydown.arrow-down="selectNextSupplier" wire:keydown.arrow-up="selectPrevious"
                        wire:keydown.enter="confirmSupplier"
                        class="text-base-content input input-bordered w-64 rounded-md mb-3" placeholder="Supplier" />

                    <?php if(!empty($suppliers) && $searchSupplier !== ($selectedSupplier->name ?? '')): ?>
                        <ul
                            class="absolute bg-white text-base-content max-h-80 overflow-y-scroll w-64 rounded-md shadow-md z-10">
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li wire:click="addSupplier(<?php echo e($supplier->id); ?>)"
                                    class="px-4 py-2 text-base-content cursor-pointer hover:bg-gray-200 <?php echo e($highlightIndex === $index ? 'bg-gray-200' : ''); ?>">
                                    <?php echo e($supplier->name); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <table
                        class="table table-zebra table-auto text-left text-base-content dark:bg-gray-800 dark:text-white border-1 shadow border-neutral">
                        <thead class="bg-neutral text-lg text-base-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-2 border-r">Produk</th>
                                <th class="p-2 border-r">Harga Beli</th>
                                <th class="p-2 border-r">Harga Jual</th>
                                <th class="p-2 border-r">Harga Grosir</th>
                                <th class="p-2 border-r">Stok</th>
                                <th class="p-2 border-r">Total Harga</th>
                                <th class="p-2 border-r">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($loop->odd ? 'bg-base-300' : 'bg-base-200'); ?>">
                                    <td><?php echo e($item['name']); ?></td>
                                    <td>
                                        <input type="text"
                                            wire:model.debounce.500ms="cart.<?php echo e($key); ?>.purchase_price" x-data
                                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                                            class="input input-sm max-w-28 rounded-md text-right"
                                            wire:change="updateTotal(<?php echo e($key); ?>, $event.target.value)">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.defer="cart.<?php echo e($key); ?>.retail_price"
                                            x-data
                                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                                            class="input input-sm max-w-28 rounded-md text-right">
                                    </td>
                                    <td>
                                        <input type="text" class="input input-sm max-w-28 rounded-md text-right"
                                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                                            value="<?php echo e($item['wholesale_price']); ?>">
                                    </td>
                                    <td class="flex items-center space-x-2">
                                        <input type="number"
                                            wire:change="updateCartStock(<?php echo e($key); ?>, $event.target.value)"
                                            class="input input-sm max-w-20 rounded-md text-right"
                                            value="<?php echo e($item['stock']); ?>" min="0">
                                    </td>
                                    <td>
                                        <input type="text" class="input input-sm w-32 rounded-md text-right"
                                            wire:model.debounce.500ms="cart.<?php echo e($key); ?>.amount" readonly
                                            value="<?php echo e($item['amount']); ?>">
                                    </td>
                                    <td class="p-2">
                                        <button wire:click="removeFromCart(<?php echo e($item['id']); ?>)">
                                            <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => 's-trash'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => ' text-error']); ?>
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

                    <?php if(!$cart): ?>
                        <p class="text-center text-gray-500 my-5">Belum ada data.</p>
                    <?php endif; ?>

                    <button wire:click="save"
                        class="btn  w-full btn-neutral hover:bg-neutral text-base-100 rounded-md dark:bg-info dark:hover:bg-green-700 mt-5">Simpan</button>

                    <?php $__errorArgs = ['supplier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-600 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views\livewire\product\update-stok.blade.php ENDPATH**/ ?>