<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-base-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @if (session()->has('message'))
                    <div class="bg-green-500 text-white font-bold p-4 mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <!-- Tombol "Tambah" di sebelah kiri -->
                    <button wire:click="create()" class="bg-neutral text-base-100 px-4 py-2 rounded-lg">
                        Tambah
                    </button>

                    <!-- Search Field di sebelah kanan -->
                    <input type="text" wire:model.live="search" class="input input-bordered w-1/3"
                        placeholder="Cari Produk..." />
                </div>


                @if ($isOpen)
                    @include('livewire.product.create')
                @endif

                @if ($isModalOpen)
                    @include('livewire.product.show')
                @endif

                <table class="table w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="w-1/6 p-3 border-r">Nama Produk</th>
                            <th class="w-1/6 p-3 border-r">Harga Beli</th>
                            <th class="w-1/6 p-3 border-r">Harga Jual</th>
                            <th class="w-1/6 p-3 border-r">Stok</th>
                            <th class="w-1/6 p-3 border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}"
                                wire:click="showDetails({{ $product->id }})">
                                <td>{{ $product->name }}</td>
                                <td>Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($product->retail_price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <button wire:click="edit({{ $product->id }})"
                                        class="px-2 text-sm text-blue-500 dark:text-blue-400">Edit</button>
                                    <button wire:click="delete({{ $product->id }})"
                                        class="px-2 text-sm text-red-500 dark:text-red-400 border-l border-neutral">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
