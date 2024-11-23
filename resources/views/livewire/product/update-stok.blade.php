<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="row mb-3">
            <div class="col-12 ">
                <x-card title="Perbarui Stok Produk" class="text-neutral bg-base-200" shadow separator>
                    <div class="flex justify-center">
                        <div class="w-full">
                            <!-- Input Search untuk Produk -->
                            <input type="text" wire:model.live="search" placeholder="Cari barang..."
                                class="input input-bordered w-full">
                            <!-- Dropdown Hasil Pencarian -->
                            @if (!empty($products))
                                <ul class="">
                                    @foreach ($products as $index => $product)
                                        <li wire:click="addToCart({{ $product->id }})"
                                            class="flex justify-between items-center py-2 border-b-2">
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
                <div class="mt-8">
                    <table
                        class="table table-zebra table-auto text-left text-base-content dark:bg-gray-800 dark:text-white border-1 shadow border-neutral">
                        <thead class="bg-neutral text-lg text-base-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-2">Produk</th>
                                <th>Stok</th>
                                <th>Perbarui</th>
                                <th>Cetak Barcode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $key => $item)
                                <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-200' }}">
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <input type="number"
                                            wire:change="updateCartStock({{ $key }}, $event.target.value)"
                                            class="input input-sm w-16" value="{{ $item['stock'] }}" min="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" wire:click="toggleChecked({{ $key }})"
                                            {{ $item['checked'] ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="checkbox" wire:click="togglePrintBarcode({{ $key }})"
                                            {{ $item['print_barcode'] ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button wire:click="save"
                        class="mt-4 w-full bg-neutral hover:bg-neutral text-base-100 font-bold py-2 px-4 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
