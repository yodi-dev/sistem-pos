<div class="text-gray-900 dark:text-gray-100">
    <div class="mx-auto sm:px-6 lg:px-0">
        <div class="row">
            <div class="col-12 ">
                <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['title' => 'Kasa','shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200']); ?>
                    <div class="flex justify-center">
                        <div x-data="{ focusSearch() { $refs.searchInput.focus(); } }" x-init="focusSearch()" @keydown.window.prevent.f8="focusSearch()"
                            @focus-search.window="focusSearch()" class="flex w-full">
                            <input type="text" wire:model.live="search" wire:keydown.arrow-down="selectNext"
                                wire:keydown.arrow-up="selectPrevious" wire:keydown.enter="confirmSelection"
                                x-ref="searchInput"
                                class="text-base-content input input-bordered w-full rounded-md me-2"
                                placeholder="Cari Produk..." />
                            <kbd class="kbd rounded-md w-12 bg-white">F8</kbd>
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if(!empty($products)): ?>
                            <ul
                                class="absolute bg-white border border-gray-300 top-40 max-h-80 overflow-y-auto w-full rounded-lg z-10">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li wire:click="addToCart(<?php echo e($product->id); ?>)"
                                        class="px-4 py-2 text-base-content cursor-pointer hover:bg-gray-200 <?php echo e($highlightIndex === $index ? 'bg-gray-200' : ''); ?>">
                                        <?php echo e($product->name); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </ul>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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

        <div class="row mt-3">
            <div class="col-12">
                <?php if (isset($component)) { $__componentOriginal7f194736b6f6432dc38786f292496c34 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f194736b6f6432dc38786f292496c34 = $attributes; } ?>
<?php $component = Mary\View\Components\Card::resolve(['shadow' => true,'separator' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Mary\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-neutral bg-base-200']); ?>
                    <input type="text" id="searchCustomer" wire:model.live="searchCustomer"
                        wire:keydown.arrow-down="selectNextCust" wire:keydown.arrow-up="selectPrevious"
                        wire:keydown.enter="confirmCustomer"
                        class="text-base-content input input-bordered w-64 rounded-md mb-3" placeholder="Pembeli" />

                    <!--[if BLOCK]><![endif]--><?php if(!empty($customers) && $searchCustomer !== ($selectedCustomer->name ?? '')): ?>
                        <ul
                            class="absolute bg-white border border-gray-300 w-fit max-h-80 overflow-y-auto top-0 mt-20 rounded-lg z-10">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li wire:click="addCustomer(<?php echo e($customer->id); ?>)"
                                    class="px-4 py-2 text-base-content cursor-pointer hover:bg-gray-200 <?php echo e($highlightIndex === $index ? 'bg-gray-200' : ''); ?>">
                                    <?php echo e($customer->name); ?> - <?php echo e($customer->address); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </ul>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <table
                        class="table table-zebra table-auto text-left text-base-content dark:bg-gray-800 dark:text-white border-1 shadow border-neutral">
                        <thead class="bg-neutral text-lg text-base-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-2 border-r">Produk</th>
                                <th class="p-2 border-r">Sub Jumlah</th>
                                <th class="p-2 border-r">Jumlah</th>
                                <th class="p-2 border-r">Harga Satuan</th>
                                <th class="p-2 border-r">Potongan</th>
                                <th colspan="2" class="p-2 border-r">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($loop->odd ? 'bg-base-300' : 'bg-base-200'); ?>">
                                    <td class="p-2"><?php echo e($item['name']); ?></td>
                                    <td class="p-2">
                                        <input type="number" id="quantity-<?php echo e($index); ?>"
                                            wire:model.live="cart.<?php echo e($index); ?>.sub_quantity"
                                            value="<?php echo e($item['sub_quantity']); ?>"
                                            wire:change="updateQuantity(<?php echo e($index); ?>, $event.target.value)"
                                            class="w-16 p-1 text-black dark:text-white bg-base-200 dark:bg-gray-700 border rounded"
                                            min="1">
                                        <select wire:model="cart.<?php echo e($index); ?>.unit"
                                            wire:change="updateQuantityOnUnitChange(<?php echo e($index); ?>)"
                                            class="select select-sm select-ghost ml-3 w-fit bg-base-200 rounded">
                                            <!--[if BLOCK]><![endif]--><?php if(empty($item['units'])): ?>
                                                <option value="1">PCS</option>
                                            <?php else: ?>
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $item['units']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <input type="number" wire:model.live="cart.<?php echo e($index); ?>.quantity"
                                            value="<?php echo e($item['quantity']); ?>"
                                            class="w-16 p-1 text-black dark:text-white bg-base-200 dark:bg-gray-700 border rounded"
                                            min="1" disabled>
                                    </td>
                                    <td class="p-2">
                                        Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?>

                                        <select class="select select-sm select-ghost ml-3 w-fit bg-base-200 rounded"
                                            wire:change="updatePriceType(<?php echo e($index); ?>, $event.target.value)">
                                            <option value="retail_price">
                                                Ecer
                                            </option>
                                            <option value="reseller_price">
                                                Reseller
                                            </option>
                                            <option value="agent_price">
                                                Agen
                                            </option>
                                            <option value="distributor_price">
                                                Grosir
                                            </option>
                                        </select>
                                    </td>

                                    <td class="p-2">
                                        <input type="number" wire:model.lazy="cart.<?php echo e($index); ?>.discount"
                                            wire:change="updateDiscount(<?php echo e($index); ?>, $event.target.value)"
                                            class="w-20 p-1 text-black dark:text-white bg-base-200 dark:bg-gray-700 border rounded"
                                            min="0" placeholder="Diskon">
                                    </td>
                                    <td class="p-2">Rp <?php echo e(number_format($item['subtotal'], 0, ',', '.')); ?></td>
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    </table>

                    <!--[if BLOCK]><![endif]--><?php if(!$cart): ?>
                        <p class="text-center text-gray-500 my-5">Belum ada barang.</p>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <div class="divider"></div>

                    <div class="grid grid-cols-2">
                        <div>
                            <h3 class="text-xl text-base-content dark:text-white">Metode Pembayaran</h3>

                            <div class="flex space-x-2 mt-2">
                                <button type="button" wire:click="addPayment('tunai')"
                                    class="px-4 py-2 rounded <?php echo e($paymentMethod === 'tunai' ? 'bg-neutral text-base-100' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100'); ?>">
                                    Tunai
                                </button>
                                <button type="button" wire:click="addPayment('QRIS')"
                                    class="px-4 py-2 rounded <?php echo e($paymentMethod === 'QRIS' ? 'bg-neutral text-base-100' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100'); ?>">
                                    QRIS
                                </button>
                                <button type="button" wire:click="addPayment('utang')"
                                    class="px-4 py-2 rounded <?php echo e($paymentMethod === 'utang' ? 'bg-neutral text-base-100' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100'); ?>">
                                    Utang
                                </button>
                            </div>
                        </div>
                        <div class=" flex flex-col space-y-2 items-end">
                            <h3
                                class="bg-base-100 px-4 py-2 text-md text-base-content text-right font-semibold dark:text-white rounded-md w-fit h-fit border-2">
                                Total:
                                Rp
                                <?php echo e(number_format($total_price, 0, ',', '.')); ?>

                            </h3>

                            <h3
                                class="bg-base-100 px-4 py-2 text-md text-base-content text-right dark:text-white rounded-md w-fit h-fit border-2">
                                Kembalian: Rp
                                <?php echo e(number_format($changeDue, 0, ',', '.')); ?>

                            </h3>
                            <div class="flex space-x-2 items-center">
                                <label for="total_paid"
                                    class="block mb-2 text-base-content dark:text-white">Bayar</label>
                                <input type="text"
                                    x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                                    id="total_paid" wire:model.live="totalPaid"
                                    class="w-full p-2 text-base-content border rounded dark:bg-gray-700 dark:text-white border-2">
                                <button type="button" icon="c-circle-stack" wire:click="clearTotalPaid"
                                    class="btn btn-sm btn-outline btn-error text-base-100 rounded-md hover:bg-red-600">X
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="grid">

                        <div class="w-full grid grid-cols-3 gap-2">
                            <button type="button" wire:click="addNominal(1000)"
                                class="btn btn-sm bg-base-300 dark:bg-gray-800 font-normal text-base-content dark:text-gray-100 rounded-md">
                                Rp 1.000
                            </button>
                            <button type="button" wire:click="addNominal(2000)"
                                class="btn btn-sm bg-base-300 dark:bg-gray-800 font-normal text-base-content dark:text-gray-100 rounded-md">
                                Rp 2.000
                            </button>
                            <button type="button" wire:click="addNominal(5000)"
                                class="btn btn-sm bg-base-300 dark:bg-gray-800 font-normal text-base-content dark:text-gray-100 rounded-md">
                                Rp 5.000
                            </button>
                            <button type="button" wire:click="addNominal(10000)"
                                class="btn btn-sm bg-base-300 dark:bg-gray-800 font-normal text-base-content dark:text-gray-100 rounded-md">
                                Rp 10.000
                            </button>
                            <button type="button" wire:click="addNominal(20000)"
                                class="btn btn-sm bg-base-300 dark:bg-gray-800 font-normal text-base-content dark:text-gray-100 rounded-md">
                                Rp 20.000
                            </button>
                            <button type="button" wire:click="addNominal(50000)"
                                class="btn btn-sm bg-base-300 dark:bg-gray-800 font-normal text-base-content dark:text-gray-100 rounded-md">
                                Rp 50.000
                            </button>
                            <button type="button" wire:click="addNominal(100000)"
                                class="btn btn-sm bg-base-300 dark:bg-gray-800 font-normal text-base-content dark:text-gray-100 rounded-md">
                                Rp 100.000
                            </button>
                            <button type="button" wire:click="bayarPas"
                                class="col-start-2 col-end-4 btn btn-sm bg-accent dark:bg-gray-800 text-base-content dark:text-gray-100 rounded-md">
                                Uang Pas
                                <kbd class="kbd kbd-xs rounded-md">F9</kbd>
                            </button>
                        </div>

                        <div class="divider"></div>

                        <div class="flex space-x-2 ">
                            <button wire:click="store"
                                class="btn w-1/2 btn-neutral hover:bg-neutral text-base-100 rounded-md dark:bg-info dark:hover:bg-green-700">
                                Simpan
                                <kbd class="kbd kbd-xs rounded-md">F10</kbd>
                            </button>
                            <button wire:click="andprint"
                                class="btn w-1/2 btn-neutral hover:bg-neutral text-base-100 rounded-md dark:bg-info dark:hover:bg-green-700">
                                Simpan & Cetak Nota
                                <kbd class="kbd kbd-xs rounded-md">F11</kbd>
                            </button>
                        </div>

                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-600 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

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
    <?php
        $__scriptKey = '1866443418-0';
        ob_start();
    ?>
    <script>
        $wire.on('focusQty', (index) => {
            const input = document.getElementById(`quantity-${index}`);
            if (input) {
                input.focus();
                input.select();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'F9') {
                event.preventDefault();
                $wire.dispatch('uangPas');
            } else
            if (event.key === 'F10') {
                event.preventDefault();
                $wire.dispatch('simpanTransaksi');
            } else
            if (event.key === 'F11') {
                event.preventDefault();
                $wire.dispatch('andPrint');
            }
        });
    </script>
    <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
<?php /**PATH C:\Users\asus\Herd\sistem-pos\resources\views/livewire/transaction/index.blade.php ENDPATH**/ ?>