<div class="text-base-content dark:text-gray-100">
    <div class="mx-auto sm:px-6 lg:px-0">
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
                            <th class="p-3 border-r">Lunasi</th>
                            <th class="p-3 border-r">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-base-content">
                        @foreach ($transactions as $index => $transaction)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td>{{ $transaction->customer->name }}</td>
                                <td>Rp {{ number_format($transaction->debt, 0, ',', '.') }}
                                </td>
                                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <input type="text" wire:model="payment.{{ $index }}.amount"
                                        x-on:input="$event.target.value = new Intl.NumberFormat('id-ID').format($event.target.value.replace(/\D/g, ''))"
                                        class="w-full input input-sm rounded-md text-right"
                                        wire:change="payDebt({{ $transaction->id }}, {{ $index }})"
                                        placeholder="Masukkan nominal">

                                </td>
                                <td>
                                    <button wire:click="lunasi({{ $transaction->id }})"
                                        class="btn btn-sm btn-success text-base-100 rounded-md">
                                        <x-icon name="c-check" />
                                    </button>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="bg-red-200 text-red-700 px-2 py-1 rounded">{{ $transaction->debt_status }}</span>
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
