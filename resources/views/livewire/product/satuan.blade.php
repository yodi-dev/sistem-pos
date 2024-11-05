 <div class="fixed inset-0 flex items-center justify-center z-50 overflow-auto h-full">
     <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
     <div class="bg-base-200 dark:bg-gray-800 w-2/3 p-5 rounded-lg shadow-lg relative z-10">
         <h2 class="text-2xl font-semibold text-neutral dark:text-base-100 text-center">Kelola Satuan Produk</h2>
         <h2 class="text-lg font-semibold text-base-content dark:text-base-100 text-center">{{ $Product->name }}</h2>

         <div class="grid grid-cols-2 gap-4 mt-3">
             <div class="border shadow p-3 flex flex-col h-full">
                 <h3 class="text-lg font-semibold text-base-content dark:text-base-100 text-center mb-3">Tambah</h3>

                 <div class="mb-3">
                     <label>Nama Satuan</label>
                     <input type="text" wire:model.debounce.500ms="unit_name"
                         class="form-control w-full text-black p-2 border rounded">
                 </div>

                 <div class="mb-3">
                     <label>Jumlah per Unit</label>
                     <input type="number" wire:model.debounce.500ms="quantity_per_unit"
                         class="form-control w-full text-black p-2 border rounded">
                 </div>

                 <!-- Tombol untuk Otomatis Mengisi Field -->
                 <div class="flex mb-5 flex-grow">
                     <button wire:click="fillDefaultValues('PCS', 1)" class="btn btn-xs btn-accent mr-2">PCS</button>
                     <button wire:click="fillDefaultValues('BKS', 1)" class="btn btn-xs btn-accent mr-2">BKS</button>
                     <button wire:click="fillDefaultValues('Renteng (10)', 10)"
                         class="btn btn-xs btn-accent mr-2">Renteng
                         (10)</button>
                     <button wire:click="fillDefaultValues('Renteng (12) ', 12)" class="btn btn-xs btn-accent">Renteng
                         (12)</button>
                 </div>

                 <button wire:click="saveUnit" class="btn btn-sm btn-neutral btn-block text-base-100">Simpan</button>
             </div>

             <div class="border shadow p-3 flex flex-col h-full">
                 <h3 class="text-lg font-semibold text-base-content dark:text-base-100 text-center mb-3">Data</h3>
                 <div class="mb-3 flex-grow">
                     <table class="table table-auto w-full border-1 border-neutral shadow">
                         <thead class="bg-neutral text-base-100 text-lg text-center">
                             <tr>
                                 <th class="border-r">Nama</th>
                                 <th class="border-r">Jumlah</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($units as $index => $item)
                                 <tr :key="$item - > id" class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                     <td>{{ $item->name }}</td>
                                     <td>{{ $item->qty }}
                                         <button wire:click="deleteUnit({{ $item->id }})">
                                             <x-icon name="s-trash" class="text-error ml-5" />
                                         </button>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>

                     </table>
                 </div>
                 <button wire:click="closeModal" class="btn btn-sm btn-error btn-block text-base-100">Tutup</button>
             </div>
         </div>
     </div>
 </div>
 </div>
