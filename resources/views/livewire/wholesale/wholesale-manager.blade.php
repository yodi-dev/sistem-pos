<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">

        @if ($showDetailModal)
            @include('livewire.wholesale.detail')
        @endif

        <x-card title="Data Kulakan" class="text-neutral bg-base-200" shadow separator>
            @if ($wholesales->isEmpty())
                <p class="text-center text-gray-500">Data kulakan belum ada.</p>
            @else
                <table class="table table-auto w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="p-3 border-r">Supplier</th>
                            <th class="p-3 border-r">Total Barang</th>
                            <th class="p-3 border-r">Tanggal</th>
                            <th class="p-3 border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-base-content">
                        @foreach ($wholesales as $wholesale)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td wire:click="show({{ $wholesale->id }})">{{ $wholesale->supplier->name }}</td>
                                <td wire:click="show({{ $wholesale->id }})" class="text-center">
                                    {{ $wholesale->total_barang }}</td>
                                <td wire:click="show({{ $wholesale->id }})">{{ $wholesale->formatted_date }}</td>
                                <td class="flex justify-center">
                                    <button wire:click="delete({{ $wholesale->id }})"
                                        class="px-2 text-sm text-neutral dark:text-red-400">
                                        <x-icon name="s-trash" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                {{-- <div class="mt-4">
                    {{ $wholesales->links() }}
                </div> --}}
            @endif
        </x-card>

    </div>
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
