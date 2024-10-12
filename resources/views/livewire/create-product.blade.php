<div class="fixed inset-0 z-10 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h2 class="text-2xl mb-4">{{ $product_id ? 'Edit Product' : 'Add Product' }}</h2>

        <div class="mb-4">
            <label>Name</label>
            <input type="text" wire:model="name" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label>Price</label>
            <input type="text" wire:model="price" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label>Stock</label>
            <input type="text" wire:model="stock" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label>Description</label>
            <textarea wire:model="description" class="w-full p-2 border rounded"></textarea>
        </div>

        <button wire:click="store()" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
        <button wire:click="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
    </div>
</div>
