<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <x-card title="Data Barang" class="text-neutral bg-base-200" shadow separator>
            <x-slot:menu>
                <a wire:navigate href="{{ route('create.product') }}"
                    class="btn btn-sm btn-neutral text-base-100 rounded-md">
                    Tambah
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
@script
    <script>
        $wire.on("showToast", (message) => {
            let toast = document.createElement("div");
            toast.className =
                `toast toast-top toast-end`;
            toast.innerHTML = `
                <div class="alert text-base-100 bg-neutral rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                ${message}</div>`;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000); // Hilang setelah 3 detik
        });

        $wire.on("showToastError", (message) => {
            let toast = document.createElement("div");
            toast.className =
                `toast toast-top toast-end`;
            toast.innerHTML = `
                <div class="alert text-base-100 bg-error rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
                </svg>
                ${message}</div>`;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000); // Hilang setelah 3 detik
        });
    </script>
@endscript
