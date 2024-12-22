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
        <x-card title="Pencatatan Utang" class="text-neutral bg-base-200" shadow separator>
            @if ($transactions->isEmpty())
                <p class="text-center text-gray-500">Belum ada data utang.</p>
            @else
                <table class="table table-auto w-full border-1 border-neutral shadow">
                    <thead class="bg-neutral text-base-100 text-lg text-center">
                        <tr>
                            <th class="p-3 border-r">Pembeli</th>
                            <th class="p-3 border-r">Total Utang</th>
                            <th class="p-3 border-r">Tanggal</th>
                            <th class="p-3 border-r">Bayar</th>
                            <th class="p-3 border-r">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-base-content">
                        @foreach ($transactions as $index => $transaction)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td>{{ $transaction->customer->name }}</td>
                                <td>Rp {{ number_format($transaction->utang, 0, ',', '.') }}
                                </td>
                                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                <td class="flex space-x-2">
                                    <input type="number" wire:model="payment.{{ $index }}.amount"
                                        class="w-full p-1 text-black dark:text-white bg-base-200 dark:bg-gray-700 border rounded"
                                        wire:change="payDebt({{ $transaction->id }}, {{ $index }})"
                                        placeholder="Masukkan nominal">
                                    <button wire:click="lunasi({{ $transaction->id }})"
                                        class="btn btn-sm btn-success text-base-100 rounded-md">
                                        <x-icon name="c-check" />
                                    </button>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="bg-red-200 text-red-700 px-2 py-1 rounded">{{ $transaction->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            @endif
        </x-card>
    </div>
</div>
