<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">

                @if (session()->has('message'))
                    <div class="bg-green-500 text-white p-3 rounded shadow-sm">
                        {{ session('message') }}
                    </div>
                @endif

                <button wire:click="create()" class="bg-neutral text-base-100 px-4 py-2 mb-4 rounded">Baru</button>

                @if ($isModalOpen)
                    @include('livewire.create-category')
                @endif

                <table class="table w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="w-2/5 p-3">Nama Kategori</th>
                            <th class="w-2/5 p-3">Keterangan</th>
                            <th class="w-1/5 p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td class=" px-4 py-2">{{ $category->name }}</td>
                                <td class=" px-4 py-2">{{ $category->description }}</td>
                                <td class=" px-4 py-2">
                                    <button wire:click="edit({{ $category->id }})"
                                        class="px-2 py-1 text-sm text-blue-500 dark:text-blue-400">Edit</button>
                                    <button wire:click="delete({{ $category->id }})"
                                        class="px-2 py-1 text-sm text-red-500 dark:text-red-400 border-l border-neutral">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
