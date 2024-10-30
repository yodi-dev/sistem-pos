<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-base-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @if (session()->has('message'))
                    <div class="bg-green-500 text-white font-bold p-4 mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <button wire:click="create()" class="bg-neutral text-base-content px-4 py-2 mb-4 rounded">Tambah</button>

                @if ($isOpen)
                    @include('livewire.create-product')
                @endif

                <table class="table-auto w-full">
                    <thead class="bg-neutral">
                        <tr>
                            <th class="w-1/6 p-3 text-left">Nama Produk</th>
                            <th class="w-1/6 p-3 text-left">Kategori</th>
                            <th class="w-1/6 p-3 text-left">Harga</th>
                            <th class="w-1/6 p-3 text-left">Stok</th>
                            <th class="w-1/6 p-3 text-left">Keterangan</th>
                            <th class="w-1/6 p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="py-2">{{ $product->category->name ?? 'No Category' }}</td>
                                <td>Rp
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <button wire:click="edit({{ $product->id }})"
                                        class="px-2 py-1 text-sm text-blue-500 dark:text-blue-400 ">Edit</button>
                                    <button wire:click="delete({{ $product->id }})"
                                        class="px-2 py-1 text-sm text-red-500 dark:text-red-400 border-l">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
