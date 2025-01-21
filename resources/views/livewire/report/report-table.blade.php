<div>
    @if (session()->has('message'))
        <div role="alert" class="alert alert-neutral mb-3 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif
    <x-card title="Laporan Harian" class="text-neutral bg-base-200" shadow separator>
        <table class="table w-full border-1 border-neutral shadow">
            <thead class="bg-neutral text-base-100 text-lg text-center">
                <tr>
                    <th class="w-2/5 border-r">Tanggal</th>
                    <th class="w-2/5 border-r">Total Pemasukkan</th>
                    <th class="w-2/5 border-r">Total Pengeluaran</th>
                    <th class="w-2/5 border-r">Tabungan</th>
                    <th class="w-2/5 border-r">Saldo</th>
                    <th class="w-2/5 border-r">Catatan</th>
                    <th class="w-1/5 border-r">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-base-content">
                @foreach ($reports as $report)
                    <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                        <td>{{ $report->report_date }}</td>
                        <td>{{ $report->total_income }}</td>
                        <td>{{ $report->total_outcome }}</td>
                        <td>{{ $report->savings }}</td>
                        <td>{{ $report->balance }}</td>
                        <td>{{ $report->notes }}</td>
                        <td class="flex justify-center">
                            <button wire:click="edit({{ $report->id }})"
                                class="px-2 text-sm text-neutral dark:text-blue-400 border-neutral">
                                <x-icon name="m-pencil-square" />
                            </button>
                            <button wire:click="delete({{ $report->id }})"
                                class="px-2 text-sm text-neutral dark:text-red-400 border-l border-neutral">
                                <x-icon name="s-trash" />
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
</div>
