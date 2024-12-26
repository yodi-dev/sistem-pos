<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-base-200 dark:bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-primary-content dark:text-base-content">
                {{ __('Selamat Datang!') }}
            </div>
        </div>
        <x-card title="Stok" class="text-neutral bg-base-200 mt-3" shadow separator>
            <x-slot:menu class="flex justify-end w-full">
                <!-- Modal Cart-->
                <x-button class="indicator btn btn-sm btn-neutral text-base-100 rounded-md mr-5"
                    onclick="modalCart.showModal()">
                    <x-icon name="o-shopping-cart" />
                    <x-badge value="{{ count($cart) }}" class="badge-accent text-base-content indicator-item" />
                </x-button>
                <dialog id="modalCart" class="modal">
                    <div class="modal-box text-base-content bg-base-300 py-3">
                        @if (empty($groupedCart))
                            <p class="text-center text-gray-500">Belum ada data kulakan.</p>
                        @else
                            @foreach ($groupedCart as $supplier => $items)
                                <div class="border-1 bg-base-200 p-3 rounded-md my-3">
                                    <h3 class="bg-base-300 w-fit px-2 py-1 rounded-md">{{ $supplier }}</h3>
                                    <table class="w-full">
                                        <tbody>
                                            @foreach ($items as $index => $item)
                                                <tr class="border-b-2 border-neutral">
                                                    <td class="p-1">{{ $item['name'] }}</td>
                                                    <td class="p-1 text-end">
                                                        <input type="number" value="{{ $item['quantity'] }}"
                                                            class="input input-sm input-bordered text-base-content w-16 max-w-xs rounded-md" />
                                                        <select wire:model="cart.{{ $index }}.unit"
                                                            wire:change="updateQuantityOnUnitChange({{ $index }})"
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
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="flex justify-end mt-3">
                                        <button
                                            class="btn btn-sm btn-neutral rounded-md w-fit text-base-100">Simpan</button>
                                    </div>
                                </div>
                            @endforeach
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
                    <option selected value="">Kategori</option>
                    @foreach ($categories as $item)
                        <option>{{ $item->name }}</option>
                    @endforeach
                </select>

                {{-- filter supplier --}}
                <select wire:model.live="supplier"
                    class="select select-bordered select-sm w-fit text-base-content rounded-md">
                    <option selected value="">Supplier</option>
                    @foreach ($suppliers as $item)
                        <option>{{ $item->name }}</option>
                    @endforeach
                </select>

                {{-- filter minimum --}}
                <label class="text-base-content">Minimum:</label>
                <input wire:model.live="minimum" type="number"
                    class="input input-sm input-bordered text-base-content w-16 max-w-xs rounded-md" />
            </x-slot:menu>

            <div class="grid grid-cols-4 gap-3 max-h-96 overflow-y-auto mb-5 p-2">
                @foreach ($products as $product)
                    <div wire:click="addToCart({{ $product->id }})"
                        class="card bg-base-100 shadow-xl text-base-content">
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
