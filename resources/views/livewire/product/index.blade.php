<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <x-card title="Data Barang" class="text-neutral bg-base-200" shadow separator>
            <x-slot:menu>
                <a wire:navigate href="{{ route('create.product') }}"
                    class="btn btn-sm btn-neutral text-base-100 rounded-md">
                    Tambah
                </a>
                <a title="Klik untuk memperbarui jumlah stok pada produk" wire:navigate
                    href="{{ route('update.products') }}" class="btn btn-sm btn-neutral text-base-100 rounded-md">
                    Perbarui Stok
                </a>
                <a title="Klik untuk mengekspor data produk" href="{{ route('export.products') }}"
                    class="btn btn-sm btn-neutral text-base-100 rounded-md">
                    Export
                </a>
                <a wire:click="import" title="Klik untuk mengimpor data produk"
                    class="btn btn-sm btn-neutral text-base-100 rounded-md">
                    Import
                </a>
                <input type="text" wire:model.live="search" class="input input-sm input-bordered rounded-md"
                    placeholder="Cari Produk..." />
            </x-slot:menu>
            @if (session('error'))
                <div class="toast toast-top toast-end">
                    <div class="alert alert-error text-base-100 rounded-md">
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if ($modalImport)
                <div class="flex justify-center w-full">
                    @include('livewire.product.import')
                </div>
            @endif

            @if ($isModalOpen)
                @include('livewire.product.show')
            @endif

            @if ($isModalSupplier)
                @include('livewire.product.supplier')
            @endif

            @if ($products->isEmpty())
                <p class="text-center text-gray-500">Belum ada data barang.</p>
            @else
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
                    <tbody class="text-base-content">
                        @foreach ($products as $product)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td wire:click="showDetails({{ $product->id }})">{{ $product->name }}</td>
                                <td wire:click="showDetails({{ $product->id }})">Rp
                                    {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                                <td wire:click="showDetails({{ $product->id }})">Rp
                                    {{ number_format($product->retail_price, 0, ',', '.') }}</td>
                                <td wire:click="showDetails({{ $product->id }})">{{ $product->stock }}</td>
                                <td wire:navigate href="{{ route('unit.product', $product->id) }}">
                                    @if ($product->units->isEmpty())
                                        <p class="text-xs text-gray-500">Klik untuk menambahkan satuan.</p>
                                    @else
                                        @foreach ($product->units as $unit)
                                            <span
                                                class="badge badge-accent py-3 px-4 my-0.5 text-base-content">{{ $unit->name }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="flex justify-center">
                                    <a title="Klik untuk menambahkan supplier" wire:navigate
                                        wire:click="openSupplierModal({{ $product->id }})"
                                        class="px-2 text-sm text-neutral dark:text-blue-400">
                                        <x-icon name="m-users" />
                                    </a>
                                    <a wire:navigate href="{{ route('barcode.product', $product->id) }}"
                                        class="px-2 text-sm text-neutral dark:text-blue-400">
                                        <x-icon name="m-qr-code" />
                                    </a>
                                    <a wire:navigate href="{{ route('edit.product', $product->id) }}"
                                        class="px-2 text-sm text-neutral dark:text-blue-400 border-l border-neutral">
                                        <x-icon name="m-pencil-square" />
                                    </a>
                                    <a wire:navigate href="{{ route('duplikat.product', $product->id) }}"
                                        class="px-2 text-sm text-neutral dark:text-blue-400 border-l border-neutral">
                                        <x-icon name="m-document-duplicate" />
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
            @endif
        </x-card>
    </div>
</div>
