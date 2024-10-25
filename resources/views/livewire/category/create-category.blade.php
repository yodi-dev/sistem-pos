<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3 mb-4 text-center sm:mt-0  sm:text-left">
                    <h2 class="text-2xl leading-6 font-medium text-gray-100" id="modal-title">
                        {{ $category_id ? 'Edit Category' : 'Create Category' }}
                    </h2>
                    <div class="mt-2">
                        <form>
                            <div>
                                <label for="name">Category Name</label>
                                <input type="text" wire:model="name" id="name" class="w-full text-black p-2 border rounded">
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                                <label for="description">Description</label>
                                <textarea wire:model="description" id="description" class="w-full text-black p-2 border rounded"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <button wire:click="store()" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                <button wire:click="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            </div>
        </div>
    </div>
</div>
