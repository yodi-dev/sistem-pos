<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 mb-4 text-center sm:mt-0  sm:text-left">
                    <h2 class="text-2xl leading-6 font-medium text-neutral" id="modal-title">
                        {{ 'Pilih Supplier' }}
                    </h2>
                    <div class="mt-2 text-base-content">
                        <form>
                            <div class="mt-4">
                                <label for="selectedSupplier">Supplier</label>
                                <select wire:change="updateSelectedSupplier" wire:model="selectedSupplier"
                                    class="select select-bordered select-sm w-fit text-base-content rounded-md">
                                    <option selected value="">Supplier</option>
                                    @foreach ($chooseSuppliers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedSupplier')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
