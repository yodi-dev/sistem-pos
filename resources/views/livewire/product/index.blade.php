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
        <div class="bg-base-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @if (session()->has('message'))
                    <div class="bg-green-500 text-white font-bold p-4 mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <!-- Tombol "Tambah" di sebelah kiri -->
                    <div class="flex space-x-4">
                        <a wire:navigate href="{{ route('create.product') }}"
                            class="bg-neutral text-base-100 px-4 py-2 rounded-lg">
                            Tambah
                        </a>
                        <!-- Tombol "Cetak Barcode" di samping tombol "Tambah" -->
                        <a title="Klik untuk memperbarui jumlah stok pada produk" href="{{ route('update.products') }}"
                            class="bg-neutral text-base-100 px-4 py-2 rounded-lg">
                            Perbarui Stok
                        </a>
                    </div>

                    <!-- Search Field di sebelah kanan -->
                    <input type="text" wire:model.live="search" class="input input-bordered w-1/3 rounded-md"
                        placeholder="Cari Produk..." />
                </div>

                @if ($isModalOpen)
                    @include('livewire.product.show')
                @elseif($isBarcodeModalOpen)
                    @include('livewire.product.barcode')
                @endif

                <table class="table table-auto w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="p-3 border-r">Nama Produk</th>
                            <th class="p-3 border-r">Harga Beli</th>
                            <th class="p-3 border-r">Harga Jual</th>
                            <th class="p-3 border-r">Stok</th>
                            <th class="p-3 border-r">Satuan</th>
                            <th class="p-3 border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td wire:click="showDetails({{ $product->id }})">{{ $product->name }}</td>
                                <td wire:click="showDetails({{ $product->id }})">Rp
                                    {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                                <td wire:click="showDetails({{ $product->id }})">Rp
                                    {{ number_format($product->retail_price, 0, ',', '.') }}</td>
                                <td wire:click="showDetails({{ $product->id }})">{{ $product->stock }}</td>
                                <td wire:navigate href="{{ route('unit.product', $product->id) }}">
                                    @foreach ($product->units as $unit)
                                        <span
                                            class="badge badge-accent py-3 px-4 my-0.5 text-base-content">{{ $unit->name }}</span>
                                    @endforeach
                                </td>
                                <td class="w-40">
                                    <button wire:click="barcode({{ $product->id }})"
                                        class="px-2 text-sm text-neutral dark:text-blue-400">
                                        <x-icon name="m-qr-code" />
                                    </button>
                                    <a href="{{ route('edit.product', $product->id) }}"
                                        class="px-2 text-sm text-neutral dark:text-blue-400 border-l border-neutral">
                                        <x-icon name="m-pencil-square" />
                                    </a>
                                    <button wire:click="delete({{ $product->id }})"
                                        class="px-2 text-sm text-neutral dark:text-red-400 border-l border-neutral">
                                        <x-icon name="s-trash" />
                                    </button>
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
