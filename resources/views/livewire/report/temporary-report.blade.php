<x-card title="Laporan Sementara" class="text-neutral bg-base-200" shadow separator>
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

    <div class="grid grid-cols-3 gap-4 text-base-content">
        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Total Pemasukkan</span>
            </div>
            <input type="number" wire:model.change="totalIncome"
                class="input input-bordered w-full max-w-32 rounded-md" />
        </label>

        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Set Saldo Awal</span>
            </div>
            <input type="number" min="1" id="opening_balance" wire:model="openingBalance"
                wire:change="setOpeningBalance" class="input input-bordered w-full max-w-32 rounded-md">
        </label>

        <div>
            <h4>Saldo</h4>
            <p class="text-base-content font-bold">Rp {{ $balance }}</p>
        </div>

        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Total Pengeluaran</span>
            </div>
            <input type="number" wire:model.change="totalOutcome"
                class="input input-bordered w-full max-w-32 rounded-md" />
        </label>

        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Set Tabungan Awal</span>
            </div>
            <input type="number" min="1" wire:model="openingSavings" wire:change="setOpeningSavings"
                class="input input-bordered w-full max-w-32 rounded-md">
        </label>

        <div>
            <h4>Tabungan</h4>
            <p class="text-base-content font-bold">Rp {{ number_format($savings, 0, ',', '.') }}</p>
        </div>

        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Tambah Tabungan</span>
            </div>
            <input type="number" wire:model="savings" class="input input-bordered w-full max-w-32 rounded-md" />
        </label>

    </div>
    <div>
        <button wire:click="generateReport" class="btn btn-neutral w-full text-base-100 mt-4 rounded-md">
            Buat Laporan
        </button>
    </div>

</x-card>
