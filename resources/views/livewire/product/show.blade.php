<div class="fixed inset-0 flex items-center justify-center z-50 overflow-auto h-full">
    <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
    <div class="bg-white dark:bg-gray-800 w-2/3 p-8 rounded-lg shadow-lg relative z-10">
        <h2 class="text-2xl font-semibold text-neutral dark:text-base-100 text-center">
            {{ $Product->name ?? 'Detail Produk' }}
        </h2>
        <h3 class="text-md font-regular text-base-content dark:text-base-100 mb-4 text-center">
            {{ $Product->code }}
        </h3>

        <div class="bg-base-200 dark:bg-gray-700 rounded-lg p-4 divide-y divide-gray-300 dark:divide-gray-600 shadow">
            <!-- Tab: Kategori -->
            <div class="flex items-center py-4">
                <span class="material-icons text-neutral dark:text-base-100 mr-2">category</span>
                <div>
                    <p class="font-semibold text-base-content dark:text-base-100">Kategori</p>
                    <p>{{ $Product->category->name ?? '-' }}</p>
                </div>
            </div>

            <!-- Tab: Harga -->
            <div class="flex items-center py-4">
                <span class="material-icons text-neutral dark:text-base-100 mr-2">attach_money</span>
                <div class="mr-5">
                    <p class="font-semibold text-base-content dark:text-base-100">Harga Beli</p>
                    <p>Rp {{ number_format($Product->purchase_price ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="mr-5">
                    <p class="font-semibold text-base-content dark:text-base-100">Harga Reseller</p>
                    <p>Rp {{ number_format($Product->reseller_price ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="mr-5">
                    <p class="font-semibold text-base-content dark:text-base-100">Harga Agen</p>
                    <p>Rp {{ number_format($Product->agent_price ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="mr-5">
                    <p class="font-semibold text-base-content dark:text-base-100">Harga Jual</p>
                    <p>Rp {{ number_format($Product->retail_price ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="mr-5">
                    <p class="font-semibold text-base-content dark:text-base-100">Harga Distributor</p>
                    <p>Rp {{ number_format($Product->distributor_price ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Tab: Stok -->
            <div class="flex items-center py-4">
                <span class="material-icons text-neutral dark:text-base-100 mr-2">inventory_2</span>
                <div>
                    <p class="font-semibold text-base-content dark:text-base-100">Stok</p>
                    <p>{{ $Product->stock ?? 0 }}</p>
                </div>
            </div>
        </div>

        <button wire:click="closeModal" class="mt-6 w-full px-4 py-2 bg-neutral text-base-100 rounded-lg">
            Tutup
        </button>
    </div>
</div>
