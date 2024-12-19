<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        @if (session('success'))
            <div role="alert" class="alert mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-12 ">
                <x-card title="Kelola Unit - {{ $product->name }}" class="text-neutral bg-base-200" shadow separator>
                    <div class="grid grid-cols-2 gap-4 mt-3">
                        <div class="border shadow p-3 flex flex-col h-full text-base-content">
                            <h3 class="text-lg font-semibold text-base-content dark:text-base-100 text-center mb-3">
                                Tambah</h3>

                            <div class="mb-3">
                                <label>Nama Satuan</label>
                                <input type="text" wire:model.debounce.500ms="unit_name"
                                    class="form-control w-full p-2 border rounded">
                            </div>

                            <div class="mb-3">
                                <label>Jumlah per Unit</label>
                                <input type="number" wire:model.debounce.500ms="quantity_per_unit"
                                    class="form-control w-full p-2 border rounded">
                            </div>

                            <!-- Tombol untuk Otomatis Mengisi Field -->
                            <div class="flex mb-5 flex-grow">
                                <button wire:click="fillDefaultValues('PCS', 1)"
                                    class="btn btn-xs btn-neutral mr-2 rounded-md text-base-100">PCS</button>
                                <button wire:click="fillDefaultValues('BKS', 1)"
                                    class="btn btn-xs btn-neutral mr-2 rounded-md text-base-100">BKS</button>
                                <button wire:click="fillDefaultValues('Renteng (10)', 10)"
                                    class="btn btn-xs btn-neutral mr-2 rounded-md text-base-100">Renteng
                                    (10)</button>
                                <button wire:click="fillDefaultValues('Renteng (12) ', 12)"
                                    class="btn btn-xs btn-neutral rounded-md text-base-100">Renteng
                                    (12)</button>
                            </div>
                            <a wire:navigate href="{{ route('products') }}"
                                class="btn btn-sm btn-outline btn-error btn-block text-base-100 rounded-md">Tutup</a>

                        </div>

                        <div class="border shadow p-3 flex flex-col h-full">
                            <h3 class="text-lg font-semibold text-base-content dark:text-base-100 text-center mb-3">Data
                            </h3>
                            <div class="mb-3 flex-grow">
                                <table class="table table-auto w-full border-1 border-neutral shadow">
                                    <thead class="bg-neutral text-base-100 text-lg text-center">
                                        <tr>
                                            <th class="border-r">Nama</th>
                                            <th class="border-r">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-base-content">
                                        @foreach ($units as $index => $item)
                                            <tr :key="$item - > id"
                                                class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                                <td>{{ $item->name }}</td>
                                                <td class="flex justify-center">{{ $item->qty }}
                                                    <button wire:click="deleteUnit({{ $item->id }})">
                                                        <x-icon name="s-trash" class="text-error ml-5" />
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <button wire:click="saveUnit"
                                class="btn btn-sm btn-neutral btn-block text-base-100 rounded-md">Simpan</button>

                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</div>
