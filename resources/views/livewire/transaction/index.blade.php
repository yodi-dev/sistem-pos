<div class="py-12 text-gray-900 dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-3 gap-4">

                <!-- Daftar Produk -->
                <div class="col-span-2">
                    <h2 class="text-xl text-center font-semibold mb-3 dark:text-white">Produk</h2>

                    <div class="mb-4 flex justify-center">
                        <!-- Input search -->
                        <input type="text" placeholder="Cari produk..." wire:model.live="search"
                            class="w-1/2 p-2 border rounded dark:bg-gray-700 dark:text-white mr-3" />

                        <!-- Filter kategori -->
                        <select wire:model.live="selectedCategory"
                            class="p-2 border rounded dark:bg-gray-700 dark:text-white">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($products as $product)
                        <div wire:click="addToCart({{ $product->id }})"
                            class="bg-white shadow-md rounded-lg overflow-hidden cursor-pointer dark:bg-gray-800 transition-transform transform hover:scale-105">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">{{ $product->name
                                    }}
                                </h3>
                                <p class="text-gray-700 dark:text-gray-300">Harga: Rp {{ number_format($product->price,
                                    0,
                                    ',',
                                    '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Keranjang -->
                <div>
                    <h2 class="text-xl text-center font-semibold mb-3 dark:text-white">Keranjang</h2>
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
                            @foreach($cart as $index => $item)
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
                    <h3 class="text-xl font-semibold mt-4 dark:text-white">Total: Rp {{ number_format($total_price, 0,
                        ',',
                        '.')
                        }}</h3>

                    <div class="mt-4">
                        <label for="total_paid" class="block mb-2 dark:text-white">Total Bayar</label>
                        <input type="number" id="total_paid" wire:model="total_paid"
                            class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white">
                    </div>

                    <button wire:click="store"
                        class="mt-4 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded dark:bg-green-600 dark:hover:bg-green-700">
                        Simpan Transaksi
                    </button>

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
</div>
