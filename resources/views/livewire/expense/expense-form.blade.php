<div>
    <form wire:submit.prevent="saveExpense">
        <div>
            <label>Tanggal</label>
            <input type="date" wire:model="date">
            @error('date')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Pengeluaran</label>
            <input type="text" wire:model="expense">
            @error('expense')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Nominal</label>
            <input type="number" wire:model="amount" step="0.01">
            @error('amount')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Catatan</label>
            <textarea wire:model="note"></textarea>
        </div>
        <button type="submit">Simpan</button>
    </form>
    @if (session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif
</div>
