<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-base-200 dark:bg-neutral border-b border-primary dark:border-gray-700 shadow-md">
    <!-- Primary Navigation Menu -->
    <x-slot:sidebar drawer="main-drawer" collapsible collapse-text="Sembunyikan" right-mobile class="bg-base-200"
        lg:bg-inherit>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-base-300 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{-- BRAND --}}
        <div class="ml-5 text-neutral pt-5">YUDISTIRA, S.Ds</div>

        <x-menu-separator />

        {{-- MENU --}}
        <x-menu activate-by-route class="text-neutral">
            <x-menu-item title="Beranda" icon="s-home" :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate />
            <x-menu-item title="KASA" icon="s-shopping-cart" :href="route('transactions')" :active="request()->routeIs('transactions')" wire:navigate />
            <x-menu-item title="Produk" icon="m-archive-box-arrow-down" :href="route('products')" :active="request()->routeIs('products')"
                wire:navigate />
            <x-menu-item title="Pembeli" icon="m-bars-arrow-down" :href="route('customers')" :active="request()->routeIs('customers')" wire:navigate />
            <x-menu-sub title="Data Master" icon="c-circle-stack">
                <x-menu-item title="Kategori" icon="s-wallet" :href="route('categories')" :active="request()->routeIs('categories')" wire:navigate />
            </x-menu-sub>

            {{-- User --}}
            @if ($user = auth()->user())
                <x-menu-separator />

                <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                    class="-mx-2 !-my-2 rounded">
                    <x-slot:actions>
                        <x-button wire:click="logout" icon="o-power" class="btn-circle btn-ghost btn-xs"
                            tooltip-left="keluar" />
                    </x-slot:actions>
                </x-list-item>

                <x-menu-separator />
            @endif

        </x-menu>
    </x-slot:sidebar>
</nav>
