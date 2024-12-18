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
        <x-card title="Data Penjualan" class="text-neutral bg-base-200" shadow separator>
            <table class="table table-auto w-full border-1 border-neutral shadow">
                <thead class="bg-neutral text-base-100 text-lg text-center">
                    <tr>
                        <th class="p-3 border-r">Pembeli</th>
                        <th class="p-3 border-r">Metode</th>
                        <th class="p-3 border-r">Total</th>
                        <th class="p-3 border-r">Bayar</th>
                        <th class="p-3 border-r">Kembalian</th>
                        <th class="p-3 border-r">Utang</th>
                        <th class="p-3 border-r">Status</th>
                        <th class="p-3 border-r">Tanggal</th>
                        <th class="p-3 border-r">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-base-content">
                    @foreach ($transactions as $transaction)
                        <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                            <td>{{ $transaction->customer ? $transaction->customer->name : '' }}
                            </td>
                            <td>{{ $transaction->payment_method }}</td>
                            <td>Rp
                                {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td>Rp
                                {{ number_format($transaction->total_paid, 0, ',', '.') }}</td>
                            <td>Rp
                                {{ number_format($transaction->change_due, 0, ',', '.') }}</td>
                            <td>{{ $transaction->utang }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>{{ $transaction->formatted_date }}</td>
                            <td class="flex">
                                <a wire:navigate href="{{ route('edit.selling', $transaction->id) }}"
                                    class="px-2 text-sm text-neutral dark:text-blue-400 border-neutral">
                                    <x-icon name="m-pencil-square" />
                                </a>
                                <button wire:click="delete({{ $transaction->id }})"
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
                {{ $transactions->links() }}
            </div>
        </x-card>

    </div>
</div>
