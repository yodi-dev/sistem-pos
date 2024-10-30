<div class="text-gray-900 dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="row">
            <div class="col-12">
                <x-card title="Produk" shadow separator>
                    <div class="mb-4 flex justify-center">
                        <!-- Input Search untuk Produk -->
                        <input type="text" wire:model.live="search" class="input input-bordered w-full"
                            placeholder="Cari Produk..." />

                        <!-- Dropdown Hasil Pencarian -->
                        @if (!empty($products))
                            <ul class="absolute bg-white border border-gray-300 w-full mt-1 rounded-lg z-10">
                                @foreach ($products as $product)
                                    <li wire:click="addToCart({{ $product->id }})"
                                        class="px-4 py-2 cursor-pointer hover:bg-gray-200">
                                        {{ $product->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </x-card>
            </div>
        </div>

        <div class="row mt-3">
            <div>
                <x-card title="Keranjang" shadow separator>
                    <table class="w-full text-left bg-white dark:bg-gray-800 dark:text-white">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-2">Produk</th>
                                <th class="p-2">Jumlah</th>
                                <th class="p-2">Subtotal</th>
                                <th class="p-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $index => $item)
                                <tr class="border-b dark:border-gray-600">
                                    <td class="p-2">{{ $item['name'] }}</td>
                                    <td class="p-2">
                                        <input type="number" value="{{ $item['quantity'] }}"
                                            wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                            class="w-16 p-1 text-black dark:text-white bg-gray-200 dark:bg-gray-700 border rounded"
                                            min="1">
                                    </td>
                                    <td class="p-2">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                    <td class="p-2">
                                        <button wire:click="removeFromCart({{ $index }})"
                                            class="text-red-500 dark:text-red-400">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3 class="text-xl font-semibold mt-4 dark:text-white">Total: Rp
                        {{ number_format($total_price, 0, ',', '.') }}</h3>

                    <div class="mt-4">
                        <label for="total_paid" class="block mb-2 dark:text-white">Total Bayar</label>
                        <input type="number" id="total_paid" wire:model="total_paid"
                            class="w-1/2 p-2 border rounded dark:bg-gray-700 dark:text-white">
                    </div>

                    <button wire:click="store"
                        class="mt-4 bg-neutral hover:bg-neutral text-base-100 font-bold py-2 px-4 rounded dark:bg-info dark:hover:bg-green-700">
                        Simpan
                    </button>
                </x-card>

                @if (session()->has('message'))
                    <div class="mt-4 p-2 bg-green-100 dark:bg-green-700 text-green-800 dark:text-green-200 rounded">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="mt-4 p-2 bg-red-100 dark:bg-red-700 text-red-800 dark:text-red-200 rounded">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
