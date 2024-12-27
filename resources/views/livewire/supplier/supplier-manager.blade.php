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

        <x-card title="Data Supplier" class="text-neutral bg-base-200" shadow separator>
            <x-slot:menu>
                <button wire:click="create()" class="btn btn-sm btn-neutral text-base-100 rounded-md">Baru</button>
            </x-slot:menu>

            @if ($isModalOpen)
                @include('livewire.supplier.create')
            @endif

            @if ($suppliers->isEmpty())
                <p class="text-center text-gray-500">Belum ada data supplier.</p>
            @else
                <table class="table w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="w-2/5 border-r">Nama Supplier</th>
                            <th class="w-1/5 border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-base-content">
                        @foreach ($suppliers as $supplier)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td>{{ $supplier->name }}</td>
                                <td class="flex justify-center">
                                    <button wire:click="edit({{ $supplier->id }})"
                                        class="px-2 text-sm text-neutral dark:text-blue-400 border-neutral">
                                        <x-icon name="m-pencil-square" />
                                    </button>
                                    <button wire:click="delete({{ $supplier->id }})"
                                        class="px-2 text-sm text-neutral dark:text-red-400 border-l border-neutral">
                                        <x-icon name="s-trash" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif
        </x-card>
    </div>
</div>
