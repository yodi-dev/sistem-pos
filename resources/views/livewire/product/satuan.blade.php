 <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
     <div class="bg-white p-6 rounded shadow-lg w-1/3">
         <h2 class="text-lg font-bold mb-4">Edit Satuan Produk</h2>

         <div class="mb-3">
             <label>Nama Satuan</label>
             <input type="text" wire:model="unit_name" class="form-control">
         </div>

         <div class="mb-3">
             <label>Jumlah per Unit</label>
             <input type="number" wire:model="quantity_per_unit" class="form-control">
         </div>

         <button wire:click="saveUnit" class="btn btn-primary">Simpan</button>
         <button wire:click="closeModal" class="btn btn-secondary">Batal</button>
     </div>
 </div>
