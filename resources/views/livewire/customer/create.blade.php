<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 mb-4 text-center sm:mt-0  sm:text-left">
                    <h2 class="text-2xl leading-6 font-medium text-neutral" id="modal-title">
                        {{ $customer_id ? 'Edit Pembeli' : 'Tambah Pembeli' }}
                    </h2>
                    <div class="mt-2 text-base-content">
                        <form>
                            <div class="mt-4">
                                <label for="code">Kode</label>
                                <input type="text" wire:model="code" id="code"
                                    class="w-full text-black p-2 border rounded">
                                @error('code')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="name">Nama Pembeli</label>
                                <input type="text" wire:model="name" id="name"
                                    class="w-full text-black p-2 border rounded">
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="address">Alamat</label>
                                <textarea wire:model="address" id="address" class="w-full text-black p-2 border rounded"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flex space-x-2 w-full">
                    <button wire:click="closeModal()"
                        class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                        Kembali</button>
                    <button wire:click="store"
                        class="btn w-1/2 bg-neutral hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
