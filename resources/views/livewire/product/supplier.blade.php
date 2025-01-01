<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex z-20 items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>

            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 mb-4 text-center sm:mt-0  sm:text-left">
                    <div class="mt-2 text-base-content">
                        <h3 class="text-lg font-bold mb-4">Supplier Produk</h3>
                        <ul class="list-disc list-inside mb-4">
                            @if ($assignedSuppliers->isEmpty())
                                <p>Belum ada supplier</p>
                            @else
                                @foreach ($assignedSuppliers as $supplier)
                                    <x-list-item class="hover:bg-base-300" :item="$supplier" />
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="mt-2 text-base-content">
                        <x-select wire:model="selectedSupplier" label="Tambah Supplier" :options="$suppliers"
                            option-value="id" option-label="name" placeholder="nama supplier" placeholder-value="0"
                            {{-- Set a value for placeholder. Default is `null` --}} class="rounded-md" />
                    </div>
                </div>
                <div class="flex space-x-2 w-full">
                    <button wire:click="closeModal()"
                        class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                        Kembali</button>
                    <button wire:click="assignSupplier"
                        class="btn w-1/2 bg-neutral hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
