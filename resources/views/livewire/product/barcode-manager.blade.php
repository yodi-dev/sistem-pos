<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        @if (session('success'))
            <div role="alert" class="alert mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-12 ">
                <x-card title="Barcode Produk - {{ $product->name }}" class="text-neutral bg-base-200" shadow separator>
                    <div class="card text-primary-content w-full shadow-lg">
                        <div class="card-body">
                            <img src="{{ $barcodeImage }}" alt="Barcode" class="border shadow-lg mb-2" />
                            <div class="card-actions justify-end">
                                <label class="block text-sm font-medium mb-1 text-base-content dark:text-base-100">
                                    Jumlah
                                </label>
                                <input type="number" wire:model="barcodeQuantity"
                                    class="form-input w-12 border rounded-md mb-1" min="1" value="1" />
                            </div>
                            <div class="flex justify-end">
                                <button wire:click="printBarcode({{ $product->id }})"
                                    class="w-12 btn-sm bg-neutral text-base-100 rounded-lg">
                                    <x-icon name="s-printer" />
                                </button>
                            </div>
                            <a wire:navigate href="{{ route('products') }}"
                                class="btn btn-sm btn-neutral btn-block text-base-100">Kembali</a>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</div>
