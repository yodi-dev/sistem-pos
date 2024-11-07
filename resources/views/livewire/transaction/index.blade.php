<div class="text-gray-900 dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="row">
            <div class="col-12 ">
                <x-card title="Produk" class="text-neutral bg-base-200" shadow separator>
                    <x-slot:menu>
                        <label for="searchCustomer">Pembeli</label>
                        <input type="text" id="searchCustomer" wire:model.live="searchCustomer"
                            wire:keydown.arrow-down="selectNextCust" wire:keydown.arrow-up="selectPrevious"
                            wire:keydown.enter="confirmCustomer" class="text-base-content input input-bordered w-full"
                            placeholder="Ketik Pembeli..." />
                        <!-- Dropdown Hasil Pencarian -->
                        @if (!empty($customers) && $searchCustomer !== ($selectedCustomer->name ?? ''))
                            <ul class="absolute bg-white border border-gray-300 w-fit top-0 mt-20 rounded-lg z-10">
                                @foreach ($customers as $index => $customer)
                                    <li wire:click="addCustomer({{ $customer->id }})"
                                        class="px-4 py-2 text-base-content cursor-pointer hover:bg-gray-200
                    {{ $highlightIndex === $index ? 'bg-gray-200' : '' }}">
                                        {{ $customer->name }} - {{ $customer->address }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </x-slot:menu>
                    <div class="flex justify-center">
                        <!-- Input Search untuk Produk -->
                        <div x-data x-init="$refs.searchInput.focus()" class="w-full">
                            <input type="text" wire:model.live="search" wire:keydown.arrow-down="selectNext"
                                wire:keydown.arrow-up="selectPrevious" wire:keydown.enter="confirmSelection"
                                x-ref="searchInput" class="text-base-content input input-bordered w-full"
                                placeholder="Cari Produk..." />
                        </div>

                        <!-- Dropdown Hasil Pencarian -->
                        @if (!empty($products))
                            <ul class="absolute bg-white border border-gray-300 top-40 w-full rounded-lg z-10">
                                @foreach ($products as $index => $product)
                                    <li wire:click="addToCart({{ $product->id }})"
                                        class="px-4 py-2 text-base-content cursor-pointer hover:bg-gray-200
                    {{ $highlightIndex === $index ? 'bg-gray-200' : '' }}">
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
            <div class="col-12">
                <x-card title="Keranjang" class="text-neutral bg-base-200" shadow separator>
                    <table
                        class="table table-zebra table-auto text-left text-base-content dark:bg-gray-800 dark:text-white border-1 shadow border-neutral">
                        <thead class="bg-neutral text-lg text-base-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-2">Produk</th>
                                <th class="p-2">Subjumlah</th>
                                <th class="p-2">Jumlah</th>
                                <th class="p-2">Harga Satuan</th>
                                <th class="p-2">Subtotal</th>
                                <th class="p-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $index => $item)
                                <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-200' }}">
                                    <td class="p-2">{{ $item['name'] }}</td>
                                    <td class="p-2">
                                        <input type="number" wire:model="cart.{{ $index }}.sub_quantity"
                                            value="{{ $item['sub_quantity'] }}"
                                            wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                            class="w-16 p-1 text-black dark:text-white bg-base-200 dark:bg-gray-700 border rounded"
                                            min="1">
                                        <select wire:model="cart.{{ $index }}.unit"
                                            wire:change="updateQuantityOnUnitChange({{ $index }})"
                                            class="select select-sm select-ghost ml-3 w-fit bg-base-200 rounded">
                                            @if (empty($item['units']))
                                                <option value="1">PCS</option>
                                            @else
                                                @foreach ($item['units'] as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <input type="number" value="{{ $item['quantity'] }}"
                                            class="w-16 p-1 text-black dark:text-white bg-base-200 dark:bg-gray-700 border rounded"
                                            min="1" disabled>
                                    </td>
                                    <td class="p-2">Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        <select class="select select-sm select-ghost ml-3 w-fit bg-base-200 rounded">
                                            <option>Grosir</option>
                                            <option>Ecer</option>
                                        </select>
                                    </td>
                                    <td class="p-2">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                    <td class="p-2">
                                        <button wire:click="removeFromCart({{ $index }})">
                                            <x-icon name="s-trash" class=" text-error" />
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="grid grid-cols-2 mt-3">
                        <div class="col-6">
                            <h3 class="text-xl text-base-content mt-4 dark:text-white">Metode Pembayaran</h3>

                            <div class="flex space-x-2 mt-2">
                                <button type="button" wire:click="addPayment('tunai')"
                                    class="px-4 py-2 rounded {{ $paymentMethod === 'tunai' ? 'bg-accent text-primary-content' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100' }}">
                                    Tunai
                                </button>
                                <button type="button" wire:click="addPayment('QRIS')"
                                    class="px-4 py-2 rounded {{ $paymentMethod === 'QRIS' ? 'bg-accent text-primary-content' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100' }}">
                                    QRIS
                                </button>
                                <button type="button" wire:click="addPayment('utang')"
                                    class="px-4 py-2 rounded {{ $paymentMethod === 'utang' ? 'bg-accent text-primary-content' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100' }}">
                                    Utang
                                </button>
                            </div>



                            @if (session()->has('message'))
                                <div
                                    class="mt-4 p-2 bg-green-100 dark:bg-green-700 text-green-800 dark:text-green-200 rounded">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <h3 class="text-xl text-base-content text-right font-semibold mt-4 dark:text-white">Total:
                                Rp
                                {{ number_format($total_price, 0, ',', '.') }}
                            </h3>

                            <h3 class="text-lg text-base-content text-right mt-4 dark:text-white">
                                Kembalian: Rp
                                {{ number_format($changeDue, 0, ',', '.') }}
                            </h3>

                            <div class="mt-4">
                                <label for="total_paid"
                                    class="block mb-2 text-base-content dark:text-white">Bayar</label>
                                <div class="flex items-center space-x-2">
                                    <input type="number" id="total_paid" wire:model.live="totalPaid"
                                        class="w-full p-2 text-base-content border rounded dark:bg-gray-700 dark:text-white">
                                    <button type="button" icon="c-circle-stack" wire:click="clearTotalPaid"
                                        class="px-4 py-2 bg-error text-base-100 rounded hover:bg-red-600">X
                                    </button>
                                </div>

                                <!-- Tombol Nominal -->
                                <div class="flex space-x-2 mt-2">
                                    <button type="button" wire:click="addNominal(10000)"
                                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded">
                                        Rp 10.000
                                    </button>
                                    <button type="button" wire:click="addNominal(20000)"
                                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded">
                                        Rp 20.000
                                    </button>
                                    <button type="button" wire:click="addNominal(50000)"
                                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded">
                                        Rp 50.000
                                    </button>
                                    <button type="button" wire:click="addNominal(100000)"
                                        class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded">
                                        Rp 100.000
                                    </button>

                                </div>
                            </div>

                            <button wire:click="store"
                                class="mt-4 w-full bg-neutral hover:bg-neutral text-base-100 font-bold py-2 px-4 rounded dark:bg-info dark:hover:bg-green-700">
                                Simpan
                            </button>
                        </div>


                    </div>

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
