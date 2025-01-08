<div class="bg-base-200 card p-5 shadow rounded-md">
    <h3 class="text-2xl text-neutral font-bold mb-4">Laporan Sementara Hari Ini</h3>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <h4>Total Pemasukkan</h4>
            <input type="number" wire:model="totalIncome" class="input input-bordered w-full max-w-32 rounded-md" />
        </div>

        <div>
            <h4>Tabungan</h4>
            <p class="text-base-content font-bold">Rp {{ number_format($savings, 0, ',', '.') }}</p>
        </div>

        <div>
            <h4>Total Pengeluaran</h4>
            <input type="number" wire:model="totalOutcome" class="input input-bordered w-full max-w-32 rounded-md" />
        </div>

        <div>
            <h4>Saldo</h4>
            <p class="text-base-content font-bold">Rp {{ number_format($balance, 0, ',', '.') }}</p>
        </div>

        <div>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Tambah Tabungan</span>
                </div>
                <input type="number" wire:model="savings" class="input input-bordered w-full max-w-32 rounded-md" />
            </label>
        </div>

        <div>
            <button class="btn btn-sm btn-neutral rounded-md text-base-100">Set Saldo Awal</button>
        </div>

    </div>

    <button wire:click="generateReport" class="btn btn-neutral text-base-100 mt-4 rounded-md">
        Buat Laporan
    </button>
</div>
