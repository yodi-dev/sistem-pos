<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex z-20 items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>
            <div class="bg-base-300 dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="bg-white text-base-content shadow rounded-lg p-6 mb-5 max-h-[300px] overflow-y-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Kulakan</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Supplier</p>
                            <p class="text-md font-semibold">{{ $selectedWholesale->supplier->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Tanggal</p>
                            <p class="text-md font-semibold">{{ $selectedWholesale->formatted_date }}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <p class="text-sm text-gray-600 font-medium mb-2">Detail Barang</p>
                        <ul class="divide-y divide-gray-200">
                            @foreach ($selectedWholesale->wholesaleItems as $item)
                                <li class="py-2 flex justify-between">
                                    <p class="font-medium">{{ $item->product->name }}</p>
                                    <p>
                                        {{ $item->quantity }} {{ $item->unit }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="flex space-x-2 w-full">
                    <button wire:click="closeModal()"
                        class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                        Kembali</button>
                    <button
                        class="btn w-1/2 bg-neutral hover:bg-base-100 text-base-100 hover:text-neutral rounded dark:bg-info dark:hover:bg-green-700">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>
