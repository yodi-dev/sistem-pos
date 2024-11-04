<!-- resources/views/livewire/product-units.blade.php -->
<div class="container mx-auto py-6">
    <h2 class="text-xl font-bold mb-4">Kelola Unit untuk Produk</h2>

    <!-- Form untuk Tambah/Edit Unit -->
    <div class="mb-6">
        <form wire:submit.prevent="saveUnit">
            <div class="mb-3">
                <label>Nama Unit</label>
                <input type="text" wire:model="unit_name" class="form-control">
                @error('unit_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Jumlah per Unit</label>
                <input type="number" wire:model="quantity_per_unit" class="form-control">
                @error('quantity_per_unit')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Harga per Unit</label>
                <input type="number" wire:model="price_per_unit" class="form-control">
                @error('price_per_unit')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Unit</button>
            <button type="button" wire:click="resetForm" class="btn btn-secondary">Batal</button>
        </form>
    </div>

    <!-- Daftar Unit -->
    <table class="table-auto w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama Unit</th>
                <th class="px-4 py-2">Jumlah per Unit</th>
                <th class="px-4 py-2">Harga per Unit</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($units as $unit)
                <tr>
                    <td class="border px-4 py-2">{{ $unit->unit_name }}</td>
                    <td class="border px-4 py-2">{{ $unit->quantity_per_unit }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($unit->price_per_unit, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="editUnit({{ $unit->id }})" class="btn btn-sm btn-warning">Edit</button>
                        <button wire:click="deleteUnit({{ $unit->id }})" class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin ingin menghapus unit ini?')">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
