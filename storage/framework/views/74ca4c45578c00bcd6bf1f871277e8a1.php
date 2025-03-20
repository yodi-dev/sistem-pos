<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">

        <!--[if BLOCK]><![endif]--><?php if($showDetailModal): ?>
            <?php echo $__env->make('livewire.wholesale.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Kulakan','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200 mt-3']); ?>
             <?php $__env->slot('menu', null, ['class' => 'flex justify-end w-full']); ?> 
                <!--[if BLOCK]><![endif]--><?php if($modalSupplier): ?>
                    <?php echo $__env->make('livewire.dashboard.choose-supplier', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <!-- Modal Cart-->
                <?php if (isset($component)) { $__componentOriginal602b228a887fab12f0012a3179e5b533 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal602b228a887fab12f0012a3179e5b533 = $attributes; } ?>
<?php $component = Mary\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'indicator btn btn-sm btn-neutral text-base-100 rounded-md mr-5','onclick' => 'modalCart.showModal()']); ?>
                    <?php if (isset($component)) { $__componentOriginalce0070e6ae017cca68172d0230e44821 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce0070e6ae017cca68172d0230e44821 = $attributes; } ?>
<?php $component = Mary\View\Components\Icon::resolve(['name' => 'o-shopping-cart'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                    <?php if (isset($component)) { $__componentOriginal4f015fb6508e425790bdb8f79792e6ed = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f015fb6508e425790bdb8f79792e6ed = $attributes; } ?>
<?php $component = Mary\View\Components\Badge::resolve(['value' => ''.e(collect($groupedCart)->map(fn($items) => collect($items)->sum('quantity'))->sum()).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Badge::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'badge-accent text-base-content indicator-item']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4f015fb6508e425790bdb8f79792e6ed)): ?>
<?php $attributes = $__attributesOriginal4f015fb6508e425790bdb8f79792e6ed; ?>
<?php unset($__attributesOriginal4f015fb6508e425790bdb8f79792e6ed); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4f015fb6508e425790bdb8f79792e6ed)): ?>
<?php $component = $__componentOriginal4f015fb6508e425790bdb8f79792e6ed; ?>
<?php unset($__componentOriginal4f015fb6508e425790bdb8f79792e6ed); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal602b228a887fab12f0012a3179e5b533)): ?>
<?php $attributes = $__attributesOriginal602b228a887fab12f0012a3179e5b533; ?>
<?php unset($__attributesOriginal602b228a887fab12f0012a3179e5b533); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal602b228a887fab12f0012a3179e5b533)): ?>
<?php $component = $__componentOriginal602b228a887fab12f0012a3179e5b533; ?>
<?php unset($__componentOriginal602b228a887fab12f0012a3179e5b533); ?>
<?php endif; ?>
                <dialog id="modalCart" class="modal" wire:ignore.self x-data @close-modal.window="modalCart.close()">
                    <div class="modal-box text-base-content bg-base-300 py-3 max-w-2xl">
                        <!--[if BLOCK]><![endif]--><?php if(empty($groupedCart)): ?>
                            <p class="text-center text-gray-500">Belum ada data kulakan.</p>
                        <?php else: ?>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $groupedCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div wire:key="grouped-cart-<?php echo e($supplier); ?>"
                                    class="border-1 bg-base-200 p-3 rounded-md my-3">
                                    <h3 class="bg-base-300 w-fit px-2 py-1 rounded-md"><?php echo e($supplier); ?></h3>
                                    <table class="w-full">
                                        <tbody>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr wire:key="cart-item-<?php echo e($supplier); ?>-<?php echo e($index); ?>"
                                                    class="border-b-2 border-neutral">
                                                    <td class="p-1"><?php echo e($item['name']); ?></td>
                                                    <td class="p-1 text-end">
                                                        <input type="number"
                                                            wire:model.lazy="groupedCart.<?php echo e($supplier); ?>.<?php echo e($index); ?>.quantity"
                                                            wire:change="updateCartQuantity(<?php echo e($supplier); ?>, <?php echo e($index); ?>, $event.target.value)"
                                                            class="input input-sm input-bordered text-base-content w-16 max-w-xs rounded-md"
                                                            min="1" />
                                                        <select
                                                            wire:model="groupedCart.<?php echo e($supplier); ?>.<?php echo e($index); ?>.unit_id"
                                                            class="select select-sm select-ghost ml-3 w-fit bg-base-200 rounded">
                                                            <!--[if BLOCK]><![endif]--><?php if(empty($item['units'])): ?>
                                                                <option value="1">PCS</option>
                                                            <?php else: ?>
                                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $item['units']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($unit->id); ?>">
                                                                        <?php echo e($unit->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                        </select>
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
<?php $component->withAttributes(['class' => 'text-error']); ?>
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
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                            <div class="flex justify-end mt-3">
                                <button wire:click="store"
                                    class="btn btn-sm btn-neutral rounded-md w-full text-base-100">Simpan</button>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <form method="dialog" class="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>

                
                <label class="text-base-content">Filter:</label>
                <select wire:model.live="category"
                    class="select select-bordered select-sm w-fit text-base-content rounded-md">
                    <option selected value="">Semua Kategori</option>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </select>

                
                <select wire:model.live="supplier"
                    class="select select-bordered select-sm w-fit text-base-content rounded-md">
                    <option selected value="">Semua Supplier</option>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </select>

                
                <label class="text-base-content">Stok Minimum:</label>
                <input wire:model.live="minimum" type="number"
                    class="input input-sm input-bordered text-base-content w-16 max-w-xs rounded-md" />
             <?php $__env->endSlot(); ?>

            <div class="grid grid-cols-4 gap-3 max-h-96 overflow-y-auto mb-5 p-2">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div wire:click="selectProduct(<?php echo e($product->id); ?>)"
                        class="card bg-base-100 hover:bg-base-300 shadow-xl text-base-content ">
                        <div class="card-body p-4 items-center justify-center">
                            <div class="card-actions">
                                <!--[if BLOCK]><![endif]--><?php if(collect($cart)->contains(fn($item) => $item['id'] === $product->id)): ?>
                                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-check-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-9 h-9 text-neutral']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <ul class="text-center">
                                <li class="text-md font-medium "><?php echo e($product->name); ?></li>
                                <li class="text-sm ">Stok saat ini : <?php echo e($product->stock); ?></li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div class="pagination">
                <?php echo e($products->links()); ?>

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

        <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Data Kulakan','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200 mt-5']); ?>
            <!--[if BLOCK]><![endif]--><?php if($wholesales->isEmpty()): ?>
                <p class="text-center text-gray-500">Data kulakan belum ada.</p>
            <?php else: ?>
                <table class="table table-auto w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="p-3 border-r">Supplier</th>
                            <th class="p-3 border-r">Total Barang</th>
                            <th class="p-3 border-r">Tanggal</th>
                            <th class="p-3 border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-base-content">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $wholesales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wholesale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="<?php echo e($loop->odd ? 'bg-base-300' : 'bg-base-100'); ?>">
                                <td wire:click="show(<?php echo e($wholesale->id); ?>)"><?php echo e($wholesale->supplier->name); ?></td>
                                <td wire:click="show(<?php echo e($wholesale->id); ?>)" class="text-center">
                                    <?php echo e($wholesale->total_barang); ?></td>
                                <td wire:click="show(<?php echo e($wholesale->id); ?>)"><?php echo e($wholesale->formatted_date); ?></td>
                                <td class="flex justify-center">
                                    <button wire:click="delete(<?php echo e($wholesale->id); ?>)"
                                        class="px-2 text-sm text-neutral dark:text-red-400">
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
                
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/wholesale/wholesale-manager.blade.php ENDPATH**/ ?>