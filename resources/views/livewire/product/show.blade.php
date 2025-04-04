<div class="fixed inset-0 flex items-center justify-center z-50 overflow-auto h-full" @click="$dispatch('closeModal')"
    wire:ignore>
    <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
    <div class="bg-white dark:bg-gray-800 w-2/3 p-5 rounded-lg shadow-lg relative z-10">
        <div class="bg-base-200 dark:bg-gray-700 rounded-lg p-4 dark:divide-gray-600 shadow">
            <h2 class="text-2xl font-semibold text-neutral dark:text-base-100 text-center">
                {{ $Product->name ?? 'Detail Produk' }}
            </h2>
            <h3 class="text-md font-regular text-base-content dark:text-base-100 text-center">
                {{ $Product->code }}
            </h3>
            <div class="divider"></div>
            <!-- Tab: Kategori -->
            <div class="flex items-center pb-4">
                <span class="material-icons text-neutral dark:text-base-100 mr-4">category</span>
                <div>
                    <p class="font-semibold text-base-content dark:text-base-100">Kategori</p>
                    <p class="text-base-content">{{ $Product->category->name ?? '-' }}</p>
                </div>

            </div>

            <!-- Tab: Harga -->
            <div class="flex items-center py-4">
                <span class="material-icons text-neutral dark:text-base-100 mr-4">attach_money</span>
                <div class="mx-2">
                    <p class=" px-4 font-semibold text-base-content dark:text-base-100">Harga Beli</p>
                    <p class="text-base-content">Rp {{ number_format($Product->purchase_price ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="mx-2">
                    <p class="px-4 font-semibold text-base-content dark:text-base-100">Harga Ecer</p>
                    <p class="text-base-content">Rp {{ number_format($Product->retail_price ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="mx-2">
                    <p class="px-4 font-semibold text-base-content dark:text-base-100">Harga Grosir</p>
                    <p class="text-base-content">Rp
                        {{ number_format($Product->wholesale_price ?? 0, 0, ',', '.') }}
                    </p>
                </div>
                <div class="mx-2">
                    <p class="px-4 font-semibold text-base-content dark:text-base-100">Harga Reseller</p>
                    <p class="text-base-content">Rp {{ number_format($Product->reseller_price ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="mx-2">
                    <p class="px-4 font-semibold text-base-content dark:text-base-100">Harga Agen</p>
                    <p class="text-base-content">Rp {{ number_format($Product->agent_price ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Tab: Stok -->
            <div class="flex items-center py-4">
                <span class="material-icons text-neutral dark:text-base-100 mr-4">inventory_2</span>
                <div>
                    <p class="font-semibold text-base-content dark:text-base-100">Stok</p>
                    <p class="text-base-content">{{ $Product->stock ?? 0 }}</p>
                </div>
            </div>

            <!-- Tab: Supplier -->
            <div class="flex items-center py-4 w-full">
                <span class="material-icons text-neutral dark:text-base-100 mr-4">
                    group
                </span>
                <div class="w-full">
                    <p class="font-semibold text-base-content dark:text-base-100">Supplier</p>
                    <ul class="list-disc list-inside mb-4">
                        @if ($Product->suppliers->isEmpty())
                            <p>Belum ada supplier</p>
                        @else
                            @foreach ($Product->suppliers as $supplier)
                                <x-list-item class="hover:bg-base-300" :item="$supplier">
                                </x-list-item>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <button wire:click="closeModal" class="mt-6 w-full px-4 py-2 bg-neutral text-base-100 rounded-lg">
            Tutup
        </button>
    </div>


</div>
