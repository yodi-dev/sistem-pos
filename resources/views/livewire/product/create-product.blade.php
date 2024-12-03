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
        <div class="row mb-3">
            <div class="col-12 ">
                @if ($isEditing)
                    <x-card title="Edit Produk" class="text-neutral bg-base-200" shadow separator>
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

                                <div class="mb-5">
                                    <select id="category" class="w-full p-2 border rounded" wire:model="category_name">
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
                                    <input type="text" wire:model="reseller_price" placeholder="Harga reseller"
                                        class="w-full text-black p-2 border rounded">
                                </div>
                            </div>

                            <div class="w-1/2">

                                <div class="mb-5">
                                    <input type="text" wire:model="agent_price" placeholder="Harga agen"
                                        class="w-full text-black p-2 border rounded">
                                </div>

                                <div class="mb-5">
                                    <input type="text" wire:model="distributor_price" placeholder="Harga distributor"
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
                        <div class="row">
                            <div class="flex">
                                <button wire:click="save"
                                    class="mr-2 w-full bg-neutral hover:bg-neutral text-base-100 font-bold py-2 px-4 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                                <button wire:navigate href="{{ route('products') }}"
                                    class="w-full bg-neutral text-center hover:bg-neutral text-base-100 font-bold py-2 px-4 rounded dark:bg-info dark:hover:bg-green-700">
                                    Kembali</button>
                            </div>
                        </div>

                    </x-card>
                @else
                    <x-card title="Tambah Produk Baru" class="text-neutral bg-base-200" shadow separator>
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

                                <div class="mb-5">
                                    <select id="category" class="w-full p-2 border rounded" wire:model="category_name">
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
                                    <input type="text" wire:model="reseller_price" placeholder="Harga reseller"
                                        class="w-full text-black p-2 border rounded">
                                </div>
                            </div>

                            <div class="w-1/2">

                                <div class="mb-5">
                                    <input type="text" wire:model="agent_price" placeholder="Harga agen"
                                        class="w-full text-black p-2 border rounded">
                                </div>

                                <div class="mb-5">
                                    <input type="text" wire:model="distributor_price"
                                        placeholder="Harga distributor" class="w-full text-black p-2 border rounded">
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
                        <div class="row">
                            <div class="flex">
                                <button wire:click="save"
                                    class="mr-2 w-full bg-neutral hover:bg-neutral text-base-100 font-bold py-2 px-4 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                                <button wire:navigate href="{{ route('products') }}"
                                    class="w-full bg-neutral text-center hover:bg-neutral text-base-100 font-bold py-2 px-4 rounded dark:bg-info dark:hover:bg-green-700">
                                    Kembali</button>
                            </div>
                        </div>

                    </x-card>
                @endif
            </div>
        </div>
    </div>
</div>
