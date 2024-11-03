<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-base-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">

                @if (session()->has('message'))
                    <div class="bg-green-500 text-white p-3 rounded shadow-sm">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="flex justify-between items-center mb-4">
                    <!-- Tombol "Tambah" di sebelah kiri -->
                    <button wire:click="create()" class="bg-neutral text-base-100 px-4 py-2 rounded-lg">Tambah</button>

                    <!-- Search Field di sebelah kanan -->
                    <input type="text" wire:model.live="search" class="input input-bordered w-1/3"
                        placeholder="Cari Produk..." />
                </div>


                @if ($isModalOpen)
                    @include('livewire.customer.create')
                @endif

                <table class="table w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="w-1/4 p-3 border-r">Nama</th>
                            <th class="w-1/4 p-3 border-r">Kode</th>
                            <th class="w-1/4 p-3 border-r">Alamat</th>
                            <th class="w-1/4 p-3 border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td class=" px-4 py-2">{{ $customer->name }}</td>
                                <td class=" px-4 py-2">{{ $customer->code }}</td>
                                <td class=" px-4 py-2">{{ $customer->address }}</td>
                                <td class=" px-4 py-2">
                                    <button wire:click="edit({{ $customer->id }})"
                                        class="px-2 py-1 text-sm text-blue-500 dark:text-blue-400">Edit</button>
                                    <button wire:click="delete({{ $customer->id }})"
                                        class="px-2 py-1 text-sm text-red-500 dark:text-red-400 border-l">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
