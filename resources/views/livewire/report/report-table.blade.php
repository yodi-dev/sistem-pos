<div>
    <x-card title="Laporan Harian" class="text-neutral bg-base-200" shadow separator>
        <x-slot:menu>
            <button wire:click="printPdf" class="btn btn-sm btn-neutral text-base-100 rounded-md">Cetak</button>
        </x-slot:menu>
        <table class="table table-auto w-full max-w-94 border-1 border-neutral shadow">
            <thead class="bg-neutral text-base-100 text-lg text-center">
                <tr>
                    <th class="border-r">Tanggal</th>
                    <th class="border-r">Pemasukkan</th>
                    <th class="border-r">Pengeluaran</th>
                    <th class="border-r">Tabungan</th>
                    <th class="border-r">Saldo</th>
                    <th class="border-r">Catatan</th>
                </tr>
            </thead>
            <tbody class="text-base-content">
                @foreach ($reports as $report)
                    <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                        <td>{{ $report->formatted_report_date }}</td>
                        <td>Rp. {{ $report->formatted_total_income }}</td>
                        <td>Rp. {{ $report->formatted_total_outcome }}</td>
                        <td>Rp. {{ $report->formatted_savings }}</td>
                        <td>Rp. {{ $report->formatted_balance }}</td>
                        <td>{{ $report->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
</div>
