<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-base-200 dark:bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-primary-content dark:text-base-content">
                {{ __('Selamat Datang!') }}
            </div>
        </div>
        <x-card title="Stok" class="text-neutral bg-base-200 mt-3" shadow separator>
            <x-slot:menu>
                <a title="Klik untuk memperbarui jumlah stok pada produk" wire:navigate
                    href="{{ route('update.products') }}" class="btn btn-sm btn-neutral text-base-100 rounded-md">
                    Perbarui Stok
                </a>
                <input wire:model.live="minimum" type="number" placeholder="Type here"
                    class="input input-sm input-bordered w-16 max-w-xs rounded-md" />
            </x-slot:menu>

            <div class="grid grid-cols-4 gap-3 max-h-96 overflow-y-auto mb-5 p-2">
                @foreach ($products as $product)
                    <div class="card bg-base-100 shadow-xl text-base-content">
                        <div class="card-body items-center justify-center p-5">
                            <p class="text-lg font-medium">{{ $product->name }}</p>
                            <p class="text-sm">Stok saat ini : {{ $product->stock }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $products->links() }}
            </div>
        </x-card>
    </div>
</div>
