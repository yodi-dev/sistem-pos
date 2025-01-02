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

        <x-card title="Pengeluaran" class="text-neutral bg-base-200" shadow separator>
            <x-slot:menu>
                <button wire:click="create" class="btn btn-sm btn-neutral text-base-100 rounded-md">Baru</button>
            </x-slot:menu>

            @if ($showCreateForm)
                <livewire:expense.expense-form />
            @endif

            @include('livewire.expense.expense-table')
        </x-card>
    </div>
</div>
