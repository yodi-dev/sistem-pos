<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Pencatatan Utang</h2>

    @if ($transactions->isEmpty())
        <p class="text-center text-gray-500">Tidak ada transaksi utang.</p>
    @else
        <table class="table-auto w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2">Customer</th>
                    <th class="px-4 py-2">Total Utang</th>
                    <th class="px-4 py-2">Tanggal Transaksi</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $transaction->customer->name }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $transaction->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            <span class="bg-red-200 text-red-700 px-2 py-1 rounded">Belum Lunas</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
