<div class="text-base-content dark:text-gray-100">
    <div class="mx-auto sm:px-6 lg:px-0">
        <x-card title="Data Kategori" class="text-neutral bg-base-200" shadow separator>
            <x-slot:menu>
                <button wire:click="create()" class="btn btn-sm btn-neutral text-base-100 rounded-md">Baru</button>
            </x-slot:menu>

            @if ($isModalOpen)
                @include('livewire.category.create-category')
            @endif

            @if ($categories->isEmpty())
                <p class="text-center text-gray-500">Belum ada data kategori.</p>
            @else
                <table class="table w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="w-2/5 border-r">Nama Kategori</th>
                            <th class="w-2/5 border-r">Keterangan</th>
                            <th class="w-1/5 border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-base-content">
                        @foreach ($categories as $category)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="flex justify-center">
                                    <button wire:click="edit({{ $category->id }})"
                                        class="px-2 text-sm text-neutral dark:text-blue-400 border-neutral">
                                        <x-icon name="m-pencil-square" />
                                    </button>
                                    <button wire:click="delete({{ $category->id }})"
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
