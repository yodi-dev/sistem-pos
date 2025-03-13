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

    <x-card title="Saldo & Tabungan Awal" class="text-neutral bg-base-200" shadow separator>
        <div class="grid grid-cols-2 gap-4 text-base-content">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Set Saldo Awal</span>
                </div>
                <input type="number" min="1" id="opening_balance" wire:model="openingBalance"
                    wire:change="setOpeningBalance" class="input input-bordered w-full rounded-md">
            </label>

            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Set Tabungan Awal</span>
                </div>
                <input type="number" min="1" id="opening_savings" wire:model="openingSavings"
                    wire:change="setOpeningSavings" class="input input-bordered w-full rounded-md">
            </label>

        </div>

        <div class="divider"></div>

        <div class="grid grid-cols-2 text-base-content">
            <div class="text-center">
                <h4>Saldo Awal</h4>
                <p class="text-base-content font-bold">Rp </p>
            </div>
            <div class="text-center">
                <h4>Tabungan Awal</h4>
                <p class="text-base-content font-bold">Rp </p>
            </div>
        </div>

        <div class="divider"></div>


        <div>
            <button wire:click="generateReport" class="btn btn-neutral w-full text-base-100 mt-4 rounded-md">
                Simpan
            </button>
        </div>

    </x-card>
</div>
