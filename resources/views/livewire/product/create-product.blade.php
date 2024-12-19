<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="row mb-3">
            <div class="col-12 ">
                @if ($isEditing)
                    <x-card title="Edit Produk" class="text-neutral bg-base-200" shadow separator>
                        <div class="flex">
                            <div class="w-1/2 mr-5">
                                <div>
                                    <div class="label">
                                        <div class="label-text">Kode Produk</div>
                                    </div>
                                    <input type="text" wire:model="code"
                                        class="w-full text-black p-2 border rounded">
                                    @error('code')
                                        <div class="label">
                                            <span class="label-text-alt">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <div class="label">
                                        <div class="label-text">Nama produk</div>
                                    </div>
                                    <input type="text" wire:model="name"
                                        class="w-full text-black p-2 border rounded">
                                </div>

                                <div>
                                    <div class="label">
                                        <div class="label-text">Kategori</div>
                                    </div>
                                    <select id="category" class="w-full text-black p-2 border rounded"
                                        wire:model="category_name">
                                        <option>Pilih kategori</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->name == $category_name ? 'selected' : '' }}
                                                value="{{ $category->name }}">{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <div class="label">
                                        <div class="label-text">Harga Beli</div>
                                    </div>
                                    <input type="text" wire:model="purchase_price"
                                        class="w-full text-black p-2 border rounded">
                                </div>

                                <div>
                                    <div class="label">
                                        <div class="label-text">Harga Ecer</div>
                                    </div>
                                    <input type="text" wire:model="retail_price"
                                        class="w-full text-black p-2 border rounded">
                                </div>
                                <div>
                                    <div class="label">
                                        <div class="label-text">Harga Reseller</div>
                                    </div>
                                    <input type="text" wire:model="reseller_price"
                                        class="w-full text-black p-2 border rounded">
                                </div>
                            </div>

                            <div class="w-1/2">
                                <div>
                                    <div class="label">
                                        <div class="label-text">Harga Agen</div>
                                    </div>
                                    <input type="text" wire:model="agent_price"
                                        class="w-full text-black p-2 border rounded">
                                </div>

                                <div>
                                    <div class="label">
                                        <div class="label-text">Harga Distributor</div>
                                    </div>
                                    <input type="text" wire:model="distributor_price"
                                        class="w-full text-black p-2 border rounded">
                                </div>

                                <div>
                                    <div class="label">
                                        <div class="label-text">Stok</div>
                                    </div>
                                    <input type="text" wire:model="stock"
                                        class="w-full text-black p-2 border rounded">
                                </div>

                                <div>
                                    <div class="label">
                                        <div class="label-text">Lokasi</div>
                                    </div>
                                    <input type="text" wire:model="location"
                                        class="w-full text-black p-2 border rounded">
                                </div>

                                <div>
                                    <div class="label">
                                        <div class="label-text">Supplier</div>
                                    </div>
                                    <input type="text" wire:model="supplier"
                                        class="w-full text-black p-2 border rounded">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="flex space-x-2 w-full">
                                <button wire:navigate href="{{ route('products') }}"
                                    class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                                    Kembali</button>
                                <button wire:click="save"
                                    class="btn w-1/2 bg-neutral hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                            </div>
                        </div>

                    </x-card>
                @else
                    <x-card title="Tambah Produk Baru" class="text-neutral bg-base-200" shadow separator>
                        <div class="row">
                            <div class="flex">
                                <div class="w-1/2 mr-5">

                                    <div class="mb-5">
                                        <input type="text" wire:model="code" placeholder="Kode produk"
                                            class="w-full text-black p-2 border rounded">
                                    </div>

                                    <div class="mb-5">
                                        <input type="text" wire:model="name" placeholder="Nama produk"
                                            class="w-full text-black p-2 border rounded">
                                    </div>

                                    <div class="mb-5 text-base-content">
                                        <select id="category" class="w-full p-2 border rounded"
                                            wire:model="category_name">
                                            <option>Pilih kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <input type="text" wire:model="purchase_price" placeholder="Harga beli"
                                            class="w-full text-black p-2 border rounded">
                                    </div>

                                    <div class="mb-5">
                                        <input type="text" wire:model="retail_price" placeholder="Harga ecer"
                                            class="w-full text-black p-2 border rounded">
                                    </div>

                                    <div class="mb-5">
                                        <input type="text" wire:model="reseller_price"
                                            placeholder="Harga reseller" class="w-full text-black p-2 border rounded">
                                    </div>
                                </div>

                                <div class="w-1/2">

                                    <div class="mb-5">
                                        <input type="text" wire:model="agent_price" placeholder="Harga agen"
                                            class="w-full text-black p-2 border rounded">
                                    </div>

                                    <div class="mb-5">
                                        <input type="text" wire:model="distributor_price"
                                            placeholder="Harga distributor"
                                            class="w-full text-black p-2 border rounded">
                                    </div>

                                    <div class="mb-5">
                                        <input type="text" wire:model="stock" placeholder="Stok"
                                            class="w-full text-black p-2 border rounded">
                                    </div>

                                    <div class="mb-5">
                                        <input type="text" wire:model="location" placeholder="Lokasi"
                                            class="w-full text-black p-2 border rounded">
                                    </div>

                                    <div class="mb-5">
                                        <input type="text" wire:model="supplier" placeholder="Suplier"
                                            class="w-full text-black p-2 border rounded">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="flex space-x-2 w-full">
                                <button wire:navigate href="{{ route('products') }}"
                                    class="btn btn-outline btn-error w-1/2  hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                                    Kembali</button>
                                <button wire:click="save"
                                    class="btn w-1/2 bg-neutral hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                            </div>
                        </div>
                    </x-card>
                @endif
            </div>
        </div>
    </div>
</div>
