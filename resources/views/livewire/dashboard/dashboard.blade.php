<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-base-200 dark:bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-primary-content dark:text-base-content">
                {{ __('Selamat Datang!') }}
            </div>
        </div>

        <x-card title="Stok" class="text-neutral bg-base-200 mt-3" shadow separator>
            <x-slot:menu class="flex justify-end w-full">
                @if ($modalSupplier)
                    @include('livewire.dashboard.choose-supplier')
                @endif
                <!-- Modal Cart-->
                <x-button class="indicator btn btn-sm btn-neutral text-base-100 rounded-md mr-5"
                    onclick="modalCart.showModal()">
                    <x-icon name="o-shopping-cart" />
                    <x-badge
                        value="{{ collect($groupedCart)->map(fn($items) => collect($items)->sum('quantity'))->sum() }}"
                        class="badge-accent text-base-content indicator-item" />
                </x-button>
                <dialog id="modalCart" class="modal" wire:ignore.self>
                    <div class="modal-box text-base-content bg-base-300 py-3 max-w-2xl">
                        @if (empty($groupedCart))
                            <p class="text-center text-gray-500">Belum ada data kulakan.</p>
                        @else
                            @foreach ($groupedCart as $supplier => $items)
                                <div wire:key="grouped-cart-{{ $supplier }}"
                                    class="border-1 bg-base-200 p-3 rounded-md my-3">
                                    <h3 class="bg-base-300 w-fit px-2 py-1 rounded-md">{{ $supplier }}</h3>
                                    <table class="w-full">
                                        <tbody>
                                            @foreach ($items as $index => $item)
                                                <tr wire:key="cart-item-{{ $supplier }}-{{ $index }}"
                                                    class="border-b-2 border-neutral">
                                                    <td class="p-1">{{ $item['name'] }}</td>
                                                    <td class="p-1 text-end">
                                                        <input type="number"
                                                            wire:model.lazy="groupedCart.{{ $supplier }}.{{ $index }}.quantity"
                                                            wire:change="updateCartQuantity({{ $supplier }}, {{ $index }}, $event.target.value)"
                                                            class="input input-sm input-bordered text-base-content w-16 max-w-xs rounded-md"
                                                            min="1" />
                                                        <select
                                                            wire:model="groupedCart.{{ $supplier }}.{{ $index }}.unit_id"
                                                            class="select select-sm select-ghost ml-3 w-fit bg-base-200 rounded">
                                                            @if (empty($item['units']))
                                                                <option value="1">PCS</option>
                                                            @else
                                                                @foreach ($item['units'] as $unit)
                                                                    <option value="{{ $unit->id }}">
                                                                        {{ $unit->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <td class="p-2">
                                                        <button wire:click="removeFromCart({{ $item['id'] }})">
                                                            <x-icon name="s-trash" class="text-error" />
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach

                            <div class="flex justify-end mt-3">
                                <button wire:click="store"
                                    class="btn btn-sm btn-neutral rounded-md w-full text-base-100">Simpan</button>
                            </div>
                        @endif
                    </div>
                    <form method="dialog" class="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>

                {{-- filter --}}
                <label class="text-base-content">Filter:</label>
                <select wire:model.live="category"
                    class="select select-bordered select-sm w-fit text-base-content rounded-md">
                    <option selected value="">Semua Kategori</option>
                    @foreach ($categories as $item)
                        <option>{{ $item->name }}</option>
                    @endforeach
                </select>

                {{-- filter supplier --}}
                <select wire:model.live="supplier"
                    class="select select-bordered select-sm w-fit text-base-content rounded-md">
                    <option selected value="">Semua Supplier</option>
                    @foreach ($suppliers as $item)
                        <option>{{ $item->name }}</option>
                    @endforeach
                </select>

                {{-- filter minimum --}}
                <label class="text-base-content">Stok Minimum:</label>
                <input wire:model.live="minimum" type="number"
                    class="input input-sm input-bordered text-base-content w-16 max-w-xs rounded-md" />
            </x-slot:menu>

            <div class="grid grid-cols-4 gap-3 max-h-96 overflow-y-auto mb-5 p-2">
                @foreach ($products as $product)
                    <div wire:click="selectProduct({{ $product->id }})"
                        class="card bg-base-100 hover:bg-base-300 shadow-xl text-base-content ">
                        <div class="card-body p-4 items-center justify-center">
                            <div class="card-actions">
                                @if (collect($cart)->contains(fn($item) => $item['id'] === $product->id))
                                    <x-heroicon-o-check-circle class="w-9 h-9 text-neutral" />
                                @endif
                            </div>
                            <ul class="text-center">
                                <li class="text-md font-medium ">{{ $product->name }}</li>
                                <li class="text-sm ">Stok saat ini : {{ $product->stock }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $products->links() }}
            </div>
        </x-card>

    </div>

    <script>
        window.addEventListener('close-modal', () => {
            document.getElementById('modalCart').close();
        });
    </script>

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
