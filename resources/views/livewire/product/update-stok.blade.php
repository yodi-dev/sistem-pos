<div class="text-base-content dark:text-gray-100">
    <div class="mx-auto sm:px-6 lg:px-0">

        <div class="row mb-3">
            <div class="col-12 ">
                <x-card title="Barang Masuk" class="text-neutral bg-base-200" shadow separator>
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
                            @if (!empty($products))
                                <ul
                                    class="absolute bg-white text-base-content max-h-80 overflow-y-scroll w-full rounded-md shadow-md z-10">
                                    @foreach ($products as $index => $product)
                                        <li wire:click="addToCart({{ $product->id }})"
                                            class="flex justify-between items-center py-2 px-4 cursor-pointer hover:bg-gray-200
                    {{ $highlightIndex === $index ? 'bg-gray-200' : '' }}">
                                            <span>{{ $product->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </x-card>
            </div>
        </div>

        <div class="bg-base-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div>
                    <input type="text" id="searchSupplier" wire:model.live="searchSupplier"
                        wire:keydown.arrow-down="selectNextSupplier" wire:keydown.arrow-up="selectPrevious"
                        wire:keydown.enter="confirmSupplier"
                        class="text-base-content input input-bordered w-64 rounded-md mb-3" placeholder="Supplier" />

                    @if (!empty($suppliers) && $searchSupplier !== ($selectedSupplier->name ?? ''))
                        <ul
                            class="absolute bg-white text-base-content max-h-80 overflow-y-scroll w-64 rounded-md shadow-md z-10">
                            @foreach ($suppliers as $index => $supplier)
                                <li wire:click="addSupplier({{ $supplier->id }})"
                                    class="px-4 py-2 text-base-content cursor-pointer hover:bg-gray-200 {{ $highlightIndex === $index ? 'bg-gray-200' : '' }}">
                                    {{ $supplier->name }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
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
                            @foreach ($cart as $key => $item)
                                <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-200' }}">
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <input type="text"
                                            wire:model.debounce.500ms="cart.{{ $key }}.purchase_price" x-data
                                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                                            class="input input-sm max-w-28 rounded-md text-right"
                                            wire:change="updateTotal({{ $key }}, $event.target.value)">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.defer="cart.{{ $key }}.retail_price"
                                            x-data
                                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                                            class="input input-sm max-w-28 rounded-md text-right">
                                    </td>
                                    <td>
                                        <input type="text" class="input input-sm max-w-28 rounded-md text-right"
                                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                                            value="{{ $item['wholesale_price'] }}">
                                    </td>
                                    <td class="flex items-center space-x-2">
                                        <input type="number"
                                            wire:change="updateCartStock({{ $key }}, $event.target.value)"
                                            class="input input-sm max-w-20 rounded-md text-right"
                                            value="{{ $item['stock'] }}" min="0">
                                    </td>
                                    <td>
                                        <input type="text" class="input input-sm w-32 rounded-md text-right"
                                            wire:model.debounce.500ms="cart.{{ $key }}.amount" readonly
                                            value="{{ $item['amount'] }}">
                                    </td>
                                    <td class="p-2">
                                        <button wire:click="removeFromCart({{ $item['id'] }})">
                                            <x-icon name="s-trash" class=" text-error" />
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if (!$cart)
                        <p class="text-center text-gray-500 my-5">Belum ada data.</p>
                    @endif

                    <button wire:click="save"
                        class="btn  w-full btn-neutral hover:bg-neutral text-base-100 rounded-md dark:bg-info dark:hover:bg-green-700 mt-5">Simpan</button>

                    @error('supplier')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
