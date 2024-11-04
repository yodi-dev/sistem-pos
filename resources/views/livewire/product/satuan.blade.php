 <div class="fixed inset-0 flex items-center justify-center z-50 overflow-auto h-full">
     <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
     <div class="bg-white dark:bg-gray-800 w-2/3 p-5 rounded-lg shadow-lg relative z-10">
         <h2 class="text-2xl font-semibold text-neutral dark:text-base-100 text-center">Kelola Satuan Produk</h2>

         <div class="grid grid-cols-2 gap-4 mt-3">
             <div class="border shadow p-3">
                 <h3 class="text-lg font-semibold text-base-content dark:text-base-100 text-center">Tambah</h3>
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

             <div class="border shadow p-3">
                 <h3 class="text-lg font-semibold text-base-content dark:text-base-100 text-center">Data</h3>
                 <div class="mb-3">
                     <table class="table table-auto w-full border-1 border-neutral shadow">
                         <thead class="bg-neutral text-base-100 text-lg text-center">
                             <tr>
                                 <th>Nama</th>
                                 <th>Jumlah</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($units as $item)
                                 <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                     <td>{{ $item->name }}</td>
                                     <td>{{ $item->qty }}</td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
