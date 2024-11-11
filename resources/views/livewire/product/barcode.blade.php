<div class="fixed inset-0 flex items-center justify-center z-50 overflow-auto h-full">
    <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
    <div class="bg-white dark:bg-gray-800 w-2/3 p-5 rounded-lg shadow-lg relative z-10">
        <h2 class="text-2xl font-semibold text-neutral dark:text-base-100 text-center">
            {{ 'Barcode Produk' }}
        </h2>
        <h3 class="text-md font-regular text-base-content dark:text-base-100 mb-4 text-center">
            {{ $Product->name }}</h3>

        @if ($barcodeImage)
            <!-- Tampilkan barcode -->
            <img src="{{ $barcodeImage }}" alt="Barcode" />
        @else
            <p>Barcode tidak tersedia</p>
        @endif

        <button wire:click="$set('isBarcodeModalOpen', false)" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">
            Tutup
        </button>
    </div>


</div>
