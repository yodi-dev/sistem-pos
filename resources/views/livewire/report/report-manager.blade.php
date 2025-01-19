<div>
    <div class="mb-6">
        @if (session('daily_report_saved'))
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
                        @foreach ($categories as $category)
                            <tr class="{{ $loop->odd ? 'bg-base-300' : 'bg-base-100' }}">
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="flex justify-center">
                                    <button wire:click="edit({{ $category->id }})"
                                        class="px-2 text-sm text-neutral dark:text-blue-400 border-neutral">
                                        <x-icon name="m-pencil-square" />
                                    </button>
                                    <button wire:click="delete({{ $category->id }})"
                                        class="px-2 text-sm text-neutral dark:text-red-400 border-l border-neutral">
                                        <x-icon name="s-trash" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-card>
        @else
            @livewire('report.temporary-report')
        @endif
    </div>

</div>
