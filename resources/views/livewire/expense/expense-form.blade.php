<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex z-20 items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>
            <x-card class="w-full mb-5 text-base-content" shadow separator>
                <x-form wire:submit.prevent="save" no-separator>
                    <x-input label="Tanggal" wire:model="date" class="rounded-md" type="date" />
                    <x-input label="Pengeluaran" wire:model="expense" class="rounded-md" />
                    <x-input label="Nominal" wire:model="amount" class="rounded-md" type="text"
                        x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))" />
                    <x-input label="Catatan" wire:model="note" class="rounded-md" />

                    <div class="flex space-x-2 w-full mt-2">
                        <button wire:click="closeModal"
                            class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                            Kembali</button>
                        <button type="submit"
                            class="btn w-1/2 bg-neutral hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                    </div>
                </x-form>
            </x-card>
        </div>
    </div>
</div>
