<div>
    @if ($isModal)
        <livewire:report.set-balance>
    @endif
    <x-card title="Laporan Sementara" class="text-neutral bg-base-200" shadow separator>
        <x-slot:menu>
            <button wire:click="openModal" class="btn btn-sm btn-neutral text-base-100 rounded-md">Set Saldo</button>
        </x-slot:menu>
        <div class="grid grid-cols-3 gap-4 text-base-content">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Pemasukkan QRIS</span>
                </div>
                <input type="text" wire:model="qrisIncome" class="input input-bordered w-full rounded-md" readonly />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Total Pemasukkan</span>
                </div>
                <input type="text"
                    x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                    wire:model.change="totalIncome" class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Total Pengeluaran</span>
                </div>
                <input type="text"
                    x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                    wire:model.change="totalOutcome" class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Tambah Tabungan</span>
                </div>
                <input type="text"
                    x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                    wire:model="addSavings" wire:change="setAddSavings"
                    class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full col-span-2">
                <div class="label">
                    <span class="label-text">Catatan</span>
                </div>
                <input type="text" wire:model="notes" class="input input-bordered w-full rounded-md" />
            </label>

        </div>

        <div class="divider"></div>

        <div class="grid grid-cols-2 text-base-content">
            <div class="text-center">
                <h4>Saldo</h4>
                <p class="text-base-content font-bold">Rp {{ $balance }}</p>
            </div>
            <div class="text-center">
                <h4>Tabungan</h4>
                <p class="text-base-content font-bold">Rp {{ $savings }}</p>
            </div>
        </div>

        <div>
            <button wire:click="generateReport" class="btn btn-neutral w-full text-base-100 mt-4 rounded-md">
                Simpan
            </button>
        </div>

    </x-card>
</div>
