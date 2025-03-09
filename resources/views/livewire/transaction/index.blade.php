<div class="text-gray-900 dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="row">
            <div class="col-12 ">
                <x-card title="Kasa" class="text-neutral bg-base-200" shadow separator>
                    <div class="flex justify-center">
                        <div x-data="{ focusSearch() { $refs.searchInput.focus(); } }" x-init="$refs.searchInput.focus()" @keydown.window.prevent.ctrl.k="focusSearch()"
                            class="w-full">

                            <input type="text" wire:model.live="search" wire:keydown.arrow-down="selectNext"
                                wire:keydown.arrow-up="selectPrevious" wire:keydown.enter="confirmSelection"
                                x-ref="searchInput" class="text-base-content input input-bordered w-full rounded-md"
                                placeholder="Cari Produk..." />

                        </div>

                        @if (!empty($products))
                            <ul
                                class="absolute bg-white border border-gray-300 top-40 max-h-80 overflow-y-auto w-full rounded-lg z-10">
                                @foreach ($products as $index => $product)
                                    <li wire:click="addToCart({{ $product->id }})"
                                        class="px-4 py-2 text-base-content cursor-pointer hover:bg-gray-200 {{ $highlightIndex === $index ? 'bg-gray-200' : '' }}">
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
                <x-card class="text-neutral bg-base-200" shadow separator>
                    <input type="text" id="searchCustomer" wire:model.live="searchCustomer"
                        wire:keydown.arrow-down="selectNextCust" wire:keydown.arrow-up="selectPrevious"
                        wire:keydown.enter="confirmCustomer"
                        class="text-base-content input input-bordered w-64 rounded-md mb-3" placeholder="Pembeli" />

                    @if (!empty($customers) && $searchCustomer !== ($selectedCustomer->name ?? ''))
                        <ul
                            class="absolute bg-white border border-gray-300 w-fit max-h-80 overflow-y-auto top-0 mt-20 rounded-lg z-10">
                            @foreach ($customers as $index => $customer)
                                <li wire:click="addCustomer({{ $customer->id }})"
                                    class="px-4 py-2 text-base-content cursor-pointer hover:bg-gray-200 {{ $highlightIndex === $index ? 'bg-gray-200' : '' }}">
                                    {{ $customer->name }} - {{ $customer->address }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
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
                            @foreach ($cart as $index => $item)
                                <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-200' }}">
                                    <td class="p-2">{{ $item['name'] }}</td>
                                    <td class="p-2">
                                        <input type="number" id="quantity-{{ $index }}"
                                            wire:model.live="cart.{{ $index }}.sub_quantity"
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
                                        <input type="number" wire:model.live="cart.{{ $index }}.quantity"
                                            value="{{ $item['quantity'] }}"
                                            class="w-16 p-1 text-black dark:text-white bg-base-200 dark:bg-gray-700 border rounded"
                                            min="1" disabled>
                                    </td>
                                    <td class="p-2">
                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        <select class="select select-sm select-ghost ml-3 w-fit bg-base-200 rounded"
                                            wire:change="updatePriceType({{ $index }}, $event.target.value)">
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
                                        <input type="number" wire:model.lazy="cart.{{ $index }}.discount"
                                            wire:change="updateDiscount({{ $index }}, $event.target.value)"
                                            class="w-20 p-1 text-black dark:text-white bg-base-200 dark:bg-gray-700 border rounded"
                                            min="0" placeholder="Diskon">
                                    </td>
                                    <td class="p-2">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
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
                        <p class="text-center text-gray-500 my-5">Belum ada barang.</p>
                    @endif

                    <div class="divider"></div>

                    <div class="grid grid-cols-2">
                        <div>
                            <h3 class="text-xl text-base-content dark:text-white">Metode Pembayaran</h3>

                            <div class="flex space-x-2 mt-2">
                                <button type="button" wire:click="addPayment('tunai')"
                                    class="px-4 py-2 rounded {{ $paymentMethod === 'tunai' ? 'bg-neutral text-base-100' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100' }}">
                                    Tunai
                                </button>
                                <button type="button" wire:click="addPayment('QRIS')"
                                    class="px-4 py-2 rounded {{ $paymentMethod === 'QRIS' ? 'bg-neutral text-base-100' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100' }}">
                                    QRIS
                                </button>
                                <button type="button" wire:click="addPayment('utang')"
                                    class="px-4 py-2 rounded {{ $paymentMethod === 'utang' ? 'bg-neutral text-base-100' : 'bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100' }}">
                                    Utang
                                </button>
                            </div>
                        </div>
                        <div class=" flex flex-col space-y-2 items-end">
                            <h3
                                class="bg-base-100 px-4 py-2 text-md text-base-content text-right font-semibold dark:text-white rounded-md w-fit h-fit border-2">
                                Total:
                                Rp
                                {{ number_format($total_price, 0, ',', '.') }}
                            </h3>

                            <h3
                                class="bg-base-100 px-4 py-2 text-md text-base-content text-right dark:text-white rounded-md w-fit h-fit border-2">
                                Kembalian: Rp
                                {{ number_format($changeDue, 0, ',', '.') }}
                            </h3>
                            <div class="flex space-x-2 items-center">
                                <label for="total_paid"
                                    class="block mb-2 text-base-content dark:text-white">Bayar</label>
                                <input type="number" id="total_paid" wire:model.live="totalPaid"
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
                                class="col-start-2 col-end-4 btn btn-sm bg-base-300 dark:bg-gray-800 text-base-content dark:text-gray-100 rounded-md">
                                Uang Pas
                            </button>
                        </div>

                        <div class="divider"></div>

                        <div class="flex space-x-2 ">
                            <button wire:click="store"
                                class="btn w-1/2 btn-neutral hover:bg-neutral text-base-100 rounded-md dark:bg-info dark:hover:bg-green-700">
                                Simpan
                            </button>
                            <button wire:click="andprint"
                                class="btn w-1/2 btn-neutral hover:bg-neutral text-base-100 rounded-md dark:bg-info dark:hover:bg-green-700">
                                Simpan & Cetak Nota
                            </button>
                        </div>

                        @error('customer')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                    </div>
                </x-card>
            </div>
        </div>
    </div>
</div>
@script
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


        $wire.on("showToast", (message) => {
            let toast = document.createElement("div");
            toast.className =
                `toast toast-top toast-end`;
            toast.innerHTML = `
                <div class="alert text-base-100 bg-neutral rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                ${message}</div>`;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000); // Hilang setelah 3 detik
        });

        $wire.on("showToastError", (message) => {
            let toast = document.createElement("div");
            toast.className =
                `toast toast-top toast-end`;
            toast.innerHTML = `
                <div class="alert text-base-100 bg-error rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
                </svg>
                ${message}</div>`;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000); // Hilang setelah 3 detik
        });
    </script>
@endscript
