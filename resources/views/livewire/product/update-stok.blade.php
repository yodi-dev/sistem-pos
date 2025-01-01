<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        @if (session('success'))
            <div role="alert" class="alert mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-12 ">
                <x-card title="Perbarui Stok Produk" class="text-neutral bg-base-200" shadow separator>
                    <div class="flex justify-center">
                        <div class="w-full relative">
                            <div x-data="{
                                focusSearch() { $refs.searchInput.focus(); }
                            }" x-init="$refs.searchInput.focus()"
                                @keydown.window.prevent.ctrl.k="focusSearch()" class="w-full">
                                <!-- Input Search untuk Produk -->
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

        @if (session('error'))
            <div role="alert" class="alert alert-error mb-3 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-base-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div>
                    <table
                        class="table table-zebra table-auto text-left text-base-content dark:bg-gray-800 dark:text-white border-1 shadow border-neutral">
                        <thead class="bg-neutral text-lg text-base-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-2 border-r">Produk</th>
                                <th class="p-2 border-r">Harga Beli</th>
                                <th class="p-2 border-r">Harga Jual</th>
                                <th class="p-2 border-r">Harga Grosir</th>
                                <th class="p-2 border-r">Tambah Stok</th>
                                <th class="p-2 border-r">Cetak Barcode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $key => $item)
                                <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-200' }}">
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <input type="number"
                                            wire:change="updateCartPurchase({{ $key }}, $event.target.value)"
                                            class="input input-sm w-24 rounded-md"
                                            value="{{ number_format($item['purchase_price'], 0, ',', '.') }}">
                                    </td>
                                    <td>
                                        <input type="number" class="input input-sm w-24 rounded-md"
                                            wire:change="updateCartRetail({{ $key }}, $event.target.value)"
                                            value="{{ number_format($item['retail_price'], 0, ',', '.') }}">
                                    </td>
                                    <td>
                                        <input type="number" class="input input-sm w-24 rounded-md"
                                            wire:change="updateCartWholesale({{ $key }}, $event.target.value)"
                                            value="{{ number_format($item['wholesale_price'], 0, ',', '.') }}">
                                    </td>
                                    <td class="flex items-center space-x-2">
                                        <span title="Stok sekarang"> {{ $item['current_stock'] }} + </span>
                                        <input type="number"
                                            wire:change="updateCartStock({{ $key }}, $event.target.value)"
                                            class="input input-sm w-16 rounded-md" value="{{ $item['stock'] }}"
                                            min="0">
                                    </td>
                                    <td>
                                        <div class="form-control">
                                            <input type="checkbox" wire:click="togglePrintBarcode({{ $key }})"
                                                class="checkbox checkbox-neutral bg-base-100 mx-auto rounded-md"
                                                {{ $item['print_barcode'] ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex space-x-2 mt-5">
                        <button wire:navigate href="{{ route('products') }}"
                            class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded-md dark:bg-info dark:hover:bg-green-700">
                            Kembali</button>
                        <button wire:click="save"
                            class="btn w-1/2 btn-neutral hover:bg-neutral text-base-100 rounded-md dark:bg-info dark:hover:bg-green-700">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
