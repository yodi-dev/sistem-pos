<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">

                @if (session()->has('message'))
                    <div class="bg-green-500 text-white p-3 rounded shadow-sm">
                        {{ session('message') }}
                    </div>
                @endif

                <button wire:click="create()" class="bg-neutral text-neutral-content px-4 py-2 mb-4 rounded">Baru</button>

                @if ($isModalOpen)
                    @include('livewire.customer.create')
                @endif

                <table class="table-auto w-full">
                    <thead class="bg-neutral text-neutral-content">
                        <tr>
                            <th class="w-1/4 p-3 text-left">Nama</th>
                            <th class="w-1/4 p-3 text-left">Kode</th>
                            <th class="w-1/4 p-3 text-left">Alamat</th>
                            <th class="w-1/4 p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="border-b">
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
            </div>
        </div>
    </div>
</div>
