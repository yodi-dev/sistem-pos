<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    @click="$dispatch('closeModal')" wire:ignore>
    <div class="flex z-20 items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            @click.stop>

            <x-card title="Saldo & Tabungan Awal" class="text-neutral bg-base-200" shadow separator>
                <div class="grid grid-cols-1 text-base-content">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Set Saldo Awal</span>
                        </div>
                        <input type="text" x-on:change="$wire.$refresh()"
                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                            id="opening_balance" wire:model="openingBalance" wire:change="setOpeningBalance"
                            class="input input-bordered w-full rounded-md">
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Set Saldo QRIS</span>
                        </div>
                        <input type="text"
                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                            wire:model="openingQris" wire:change="setQrisBalance"
                            class="input input-bordered w-full rounded-md">
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Set Tabungan Awal</span>
                        </div>
                        <input type="text"
                            x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                            id="opening_savings" wire:model="openingSavings" wire:change="setOpeningSavings"
                            class="input input-bordered w-full rounded-md">
                    </label>
                </div>

                <div class="divider"></div>

                <div class="grid grid-cols-3 text-base-content">
                    <div class="text-center">
                        <h4>Saldo Awal</h4>
                        <p class="text-base-content font-bold">Rp {{ $openingBalance }}</p>
                    </div>
                    <div class="text-center">
                        <h4>Saldo QRIS</h4>
                        <p class="text-base-content font-bold">Rp {{ $openingQris }}</p>
                    </div>
                    <div class="text-center">
                        <h4>Tabungan Awal</h4>
                        <p class="text-base-content font-bold">Rp {{ $openingSavings }}</p>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</div>
