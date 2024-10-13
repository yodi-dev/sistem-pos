<div class="py-12 text-gray-900 dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl">
            <div class="p-6">
                @if (session()->has('message'))
                    <div class="bg-green-500 text-white font-bold p-4 mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <button wire:click="create()" class="bg-blue-500 text-white px-4 py-2 mb-4 rounded">Add</button>

                @if($isOpen)
                    @include('livewire.create-product')
                @endif

                <table class="table-auto w-full">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="w-1/6 p-3 text-left">Name</th>
                            <th class="w-1/6 p-3 text-left">Category</th>
                            <th class="w-1/6 p-3 text-left">Price</th>
                            <th class="w-1/6 p-3 text-left">Stock</th>
                            <th class="w-1/6 p-3 text-left">Description</th>
                            <th class="w-1/6 p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @foreach($products as $product)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="py-2">{{ $product->category->name ?? 'No Category' }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <button wire:click="edit({{ $product->id }})" class="px-2 py-1 text-sm rounded bg-blue-500 text-white">Edit</button>
                                    <button wire:click="delete({{ $product->id }})" class="px-2 py-1 text-sm rounded bg-blue-500 text-white">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


