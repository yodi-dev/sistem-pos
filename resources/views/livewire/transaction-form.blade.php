<div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4 dark:text-white">Transaksi Penjualan</h1>

    <div class="grid grid-cols-2 gap-4">
        <!-- Daftar Produk -->
        <div>
            <h2 class="text-xl font-semibold mb-2 dark:text-white">Produk</h2>
            <ul>
                @foreach($products as $product)
                    <li class="mb-2">
                        <button wire:click="addToCart({{ $product->id }})"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded dark:bg-blue-600 dark:hover:bg-blue-700">
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Keranjang -->
        <div>
            <h2 class="text-xl font-semibold mb-2 dark:text-white">Keranjang</h2>
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
                                <input type="number"
                                       wire:model="cart.{{ $index }}.quantity"
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
            <h3 class="text-xl font-semibold mt-4 dark:text-white">Total: Rp {{ number_format($total_price, 0, ',', '.') }}</h3>

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
