<div class="text-base-content dark:text-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-0">
        <div class="row mb-3">
            <div class="col-12 ">
                <x-card title="Edit Data Penjualan" class="text-neutral bg-base-200" shadow separator>
                    <div class="flex">
                        <div class="w-1/2 mr-5">

                            <div>
                                <div class="label">
                                    <div class="label-text">Pembeli</div>
                                </div>

                                <select id="category" class="w-full text-base-content p-2 border rounded"
                                    wire:model="customer_id">
                                    <option>Pilih pembeli</option>
                                    @foreach ($customers as $customer)
                                        <option {{ $transaction_id == $customer->id ? 'selected' : '' }}
                                            value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>

                                @error('pembeli')
                                    <div class="label">
                                        <span class="label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Metode Pembayaran</div>
                                </div>
                                <select class="w-full text-base-content p-2 border rounded" wire:model="payment_method">
                                    <option {{ $payment_method == 'tunai' ? 'selected' : '' }} value="tunai">Tunai
                                    </option>
                                    <option {{ $payment_method == 'QRIS' ? 'selected' : '' }} value="QRIS">QRIS
                                    </option>
                                    <option {{ $payment_method == 'utang' ? 'selected' : '' }} value="utang">Utang
                                    </option>
                                </select>

                                @error('payment_method')
                                    <div class="label">
                                        <span class="label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Total Belanja</div>
                                </div>
                                <input type="text" wire:model.change="total_price"
                                    class="w-full text-black p-2 border rounded">
                                @error('total_price')
                                    <div class="label">
                                        <span class="label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Total Bayar</div>
                                </div>
                                <input type="text" wire:model.change="total_paid"
                                    class="w-full text-black p-2 border rounded">
                                @error('total_paid')
                                    <div class="label">
                                        <span class="label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="w-1/2">

                            <div>
                                <div class="label">
                                    <div class="label-text">Kembalian</div>
                                </div>
                                <input type="text" wire:model.change="change_due"
                                    class="w-full text-black p-2 border rounded">
                                @error('change_due')
                                    <div class="label">
                                        <span class="label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Utang</div>
                                </div>
                                <input type="text" wire:model.change="debt"
                                    class="w-full text-black p-2 border rounded">
                                @error('debt')
                                    <div class="label">
                                        <span class="label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Status Utang</div>
                                </div>
                                <select class="w-full text-base-content p-2 border rounded" wire:model="debt_status">
                                    <option {{ $payment_method == 'Lunas' ? 'selected' : '' }} value="Lunas">Lunas
                                    </option>
                                    <option {{ $payment_method == 'Belum Lunas' ? 'selected' : '' }}
                                        value="Belum Lunas">Belum Lunas
                                    </option>
                                </select>
                                @error('debt_status')
                                    <div class="label">
                                        <span class="label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <div class="label">
                                    <div class="label-text">Tanggal</div>
                                </div>
                                <input type="date" wire:model="date" class="w-full text-black p-2 border rounded">
                                @error('date')
                                    <div class="label">
                                        <span class="label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="flex mt-5">
                        <div class="w-1/2 mr-5">
                            <button wire:navigate href="{{ route('selling') }}"
                                class="btn btn-outline btn-error w-full text-center hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">
                                Kembali</button>
                        </div>
                        <div class="w-1/2">
                            <button wire:click="save"
                                class="btn w-full btn-neutral hover:bg-neutral text-base-100 rounded dark:bg-info dark:hover:bg-green-700">Simpan</button>
                        </div>
                    </div>
                </x-card>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('#category').selectize({
                placeholder: 'Pilih pembeli...',
                allowEmptyOption: true,
            });
        });
    </script>

</div>
