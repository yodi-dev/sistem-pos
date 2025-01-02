<div>
    <div class="flex justify-center text-base-content">
        <x-card class="max-w-md w-full mb-5" shadow separator>
            <x-form wire:submit.prevent="save" no-separator>
                <x-input label="Tanggal" wire:model="date" class="rounded-md" type="date" />
                <x-input label="Pengeluaran" wire:model="expense" class="rounded-md" />
                <x-input label="Nominal" wire:model="amount" class="rounded-md" type="number" />
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
