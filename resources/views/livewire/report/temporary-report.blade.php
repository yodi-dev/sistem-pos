<div class="bg-base-100 card p-4 shadow">
    <h3 class="text-lg text-neutral font-bold mb-4">Laporan Sementara Hari Ini</h3>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <h4>Total Pemasukkan</h4>
            <p class="text-base-content font-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>
        <div>
            <h4>Total Pengeluaran</h4>
            <p class="text-base-content font-bold">Rp {{ number_format($totalOutcome, 0, ',', '.') }}</p>
        </div>
        <div>
            <h4>Tabungan</h4>
            <p class="text-base-content font-bold">Rp {{ number_format($savings, 0, ',', '.') }}</p>
        </div>
        <div>
            <h4>Saldo</h4>
            <p class="text-base-content font-bold">Rp {{ number_format($balance, 0, ',', '.') }}</p>
        </div>
        <div>
            <label for="savings">Tambah Tabungan</label>
            <input type="number" wire:model="savings" id="savings" class="form-control"
                placeholder="Masukkan tabungan">
        </div>
    </div>

    <button wire:click="generateReport" class="btn btn-neutral text-base-100 mt-4 rounded-md">
        Buat Laporan
    </button>
</div>
