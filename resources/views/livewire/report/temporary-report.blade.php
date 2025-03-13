<div>
    @if (session()->has('message'))
        <div role="alert" class="alert alert-neutral mb-3 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <x-card title="Laporan Sementara" class="text-neutral bg-base-200" shadow separator>
        <div class="grid grid-cols-3 gap-4 text-base-content">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Total Pemasukkan</span>
                </div>
                <input type="number" wire:model.change="totalIncome" class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Total Pengeluaran</span>
                </div>
                <input type="number" wire:model.change="totalOutcome" class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Tambah Tabungan</span>
                </div>
                <input type="number" wire:model="addSavings" wire:change="setAddSavings"
                    class="input input-bordered w-full rounded-md" />
            </label>

            <label class="form-control w-full col-span-3">
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

        <div class="divider"></div>


        <div>
            <button wire:click="generateReport" class="btn btn-neutral w-full text-base-100 mt-4 rounded-md">
                Simpan
            </button>
        </div>

    </x-card>
</div>
