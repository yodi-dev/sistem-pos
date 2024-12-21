<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        @if (session()->has('message'))
            <div role="alert" class="alert mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        @endif
        <x-card title="Data Pembeli" class="text-neutral bg-base-200" shadow separator>
            <x-slot:menu>
                <button wire:click="create()" class="btn btn-sm btn-neutral text-base-100 rounded-md">Tambah</button>
                <!-- Search Field di sebelah kanan -->
                <input type="text" wire:model.live="search"
                    class="input input-sm input-bordered rounded-md text-base-content" placeholder="Cari pembeli..." />
            </x-slot:menu>

            @if ($isModalOpen)
                @include('livewire.customer.create')
            @endif

            @if ($customers->isEmpty())
                <p class="text-center text-gray-500">Belum ada data pembeli.</p>
            @else
                <table class="table table-auto w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="p-3 border-r">Nama</th>
                            <th class="p-3 border-r">Kode</th>
                            <th class="p-3 border-r">Alamat</th>
                            <th class="p-3 border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-base-content">
                        @foreach ($customers as $customer)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->code }}</td>
                                <td>{{ $customer->address }}</td>
                                <td class="flex justify-center">
                                    <button wire:click="edit({{ $customer->id }})"
                                        class="px-2 text-sm text-neutral dark:text-blue-400 border-neutral">
                                        <x-icon name="m-pencil-square" />
                                    </button>
                                    <button wire:click="delete({{ $customer->id }})"
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
                    {{ $customers->links() }}
                </div>

            @endif
        </x-card>
    </div>
</div>
