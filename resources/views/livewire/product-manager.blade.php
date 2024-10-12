<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @if (session()->has('message'))
                    <div class="bg-green-500 text-white font-bold p-4 mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <button wire:click="create()" class="bg-blue-500 text-white px-4 py-2 mb-4 rounded">Add Product</button>

                @if($isOpen)
                    @include('livewire.create-product')
                @endif

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <button wire:click="edit({{ $product->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                    <button wire:click="delete({{ $product->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


