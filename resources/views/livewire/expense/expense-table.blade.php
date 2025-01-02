<div>
    @if ($expenses->isEmpty())
        <p class="text-center text-gray-500">Belum ada Pengeluaran.</p>
    @else
        <table class="table w-full border-1 border-neutral shadow">
            <thead class="bg-neutral text-base-100 text-lg text-center">
                <tr>
                    <th class="w-2/5 border-r">Tanggal</th>
                    <th class="w-2/5 border-r">Pengeluaran</th>
                    <th class="w-2/5 border-r">Nominal</th>
                    <th class="w-2/5 border-r">Catatan</th>
                    <th class="w-1/5 border-r">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-base-content">
                @foreach ($expenses as $expense)
                    <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->expense }}</td>
                        <td>Rp. {{ number_format($expense->amount, 0, ',', '.') }}</td>
                        <td>{{ $expense->note }}</td>
                        <td class="flex justify-center">
                            <button wire:click="edit({{ $expense->id }})"
                                class="px-2 text-sm text-neutral dark:text-blue-400 border-neutral">
                                <x-icon name="m-pencil-square" />
                            </button>
                            <button wire:click="delete({{ $expense->id }})"
                                class="px-2 text-sm text-neutral dark:text-red-400 border-l border-neutral">
                                <x-icon name="s-trash" />
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $expenses->links() }}
        </div>
    @endif
</div>
