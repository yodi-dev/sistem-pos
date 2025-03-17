<div class="text-base-content dark:text-gray-100">
    <div class="mx-auto sm:px-6 lg:px-0">
        <x-card title="Pengeluaran" class="text-neutral bg-base-200" shadow separator>
            <x-slot:menu>
                <button wire:click="create" class="btn btn-sm btn-neutral text-base-100 rounded-md">Baru</button>
            </x-slot:menu>

            @if ($showForm)
                <livewire:expense.expense-form :expenseId="$selectedExpenseId" />
            @endif

            @include('livewire.expense.expense-table')
        </x-card>
    </div>
</div>
