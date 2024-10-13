<div class="py-12 text-gray-900 dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">

                @if (session()->has('message'))
                <div class="bg-green-500 text-white p-3 rounded shadow-sm">
                    {{ session('message') }}
                </div>
                @endif

                <button wire:click="create()" class="bg-blue-500 text-white px-4 py-2 mb-4 rounded">Baru</button>

                @if($isModalOpen)
                @include('livewire.create-category')
                @endif

                <table class="table-auto w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="w-2/5 p-3 text-left">Nama Kategori</th>
                            <th class="w-2/5 p-3 text-left">Keterangan</th>
                            <th class="w-1/5 p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @foreach($categories as $category)
                        <tr class="border-b">
                            <td class=" px-4 py-2">{{ $category->name }}</td>
                            <td class=" px-4 py-2">{{ $category->description }}</td>
                            <td class=" px-4 py-2">
                                <button wire:click="edit({{ $category->id }})"
                                    class="px-2 py-1 text-sm text-blue-500 dark:text-blue-400">Edit</button>
                                <button wire:click="delete({{ $category->id }})"
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
