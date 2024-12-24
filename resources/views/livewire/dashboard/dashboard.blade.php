<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-base-200 dark:bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-primary-content dark:text-base-content">
                {{ __('Selamat Datang!') }}
            </div>
        </div>
        <x-card title="Stok" class="text-neutral bg-base-200 mt-3" shadow separator>
            <x-slot:menu>
                <div class="dropdown dropdown-end text-base-content">
                    <div tabindex="0" role="button" class="btn btn-sm btn-neutral text-base-100 m-1 rounded-md"><x-icon
                            name="o-shopping-cart" />
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-md z-[1] w-80 p-2 shadow p-3">
                        @if (empty($cart))
                            <p class="text-center text-gray-500">Belum ada data kulakan.</p>
                        @else
                            <table>
                                <tbody>
                                    @foreach ($cart as $index => $item)
                                        <tr class="border-b-2 border-neutral">
                                            <td class="p-1">{{ $item['name'] }}</td>
                                            <td class="p-1"><input type="number" value="{{ $item['quantity'] }}"
                                                    class="input input-sm input-bordered text-base-content w-16 max-w-xs rounded-md" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="flex justify-end mt-3">
                                <button class="btn btn-sm btn-neutral rounded-md w-fit text-base-100">Simpan</button>
                            </div>
                        @endif
                    </ul>
                </div>
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
