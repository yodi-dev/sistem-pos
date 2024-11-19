<div class="fixed inset-0 flex items-center justify-center z-50 overflow-auto h-full">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
    <!-- Modal -->
    <div class="bg-white dark:bg-gray-800 w-1/2 p-5 rounded-lg  relative z-10">
        <header class="border-b mb-2">
            <h2 class="text-2xl font-semibold text-neutral dark:text-base-100 text-center">
                Barcode Produk
            </h2>
            <h3 class="text-md text-base-content dark:text-base-100 text-center mb-2">
                {{ $Product->name }}
            </h3>
        </header>
        <div class="card text-primary-content w-full shadow-lg">
            <div class="card-body">
                <img src="{{ $barcodeImage }}" alt="Barcode" class="border shadow-lg mb-2" />
                <div class="card-actions justify-end">
                    <label class="block text-sm font-medium mb-1 text-base-content dark:text-base-100">
                        Jumlah
                    </label>
                    <input type="number" wire:model="barcodeQuantity" class="form-input w-12 border rounded mb-1"
                        min="1" value="1" />
                </div>
                <div class="flex justify-end">
                    <button wire:click="printBarcode({{ $Product->id }})"
                        class="w-12 btn-sm bg-neutral text-base-100 rounded-lg">
                        <x-icon name="s-printer" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Close Button -->
        <button wire:click="$set('isBarcodeModalOpen', false)"
            class="mt-3 w-full px-2 py-2 bg-neutral text-base-100 rounded-lg">
            Tutup
        </button>
    </div>
</div>
