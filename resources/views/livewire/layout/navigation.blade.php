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
        <div class="ml-5 text-neutral text-xl pt-5 font-semibold">Habiba Store</div>
        <x-menu-separator />

        {{-- MENU --}}
        <x-menu activate-by-route class="text-base-content">
            <x-menu-item title="Beranda" icon="s-home" :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate />
            <x-menu-item title="KASA" icon="s-shopping-cart" :href="route('transactions')" :active="request()->routeIs('transactions')" wire:navigate />
            <x-menu-item title="Pengeluaran" icon="s-presentation-chart-bar" :href="route('expenses')" :active="request()->routeIs('expenses')"
                wire:navigate />

            <x-menu-sub title="Manajemen" icon="s-rectangle-stack">
                <x-menu-item title="Data Jual" icon="s-presentation-chart-line" :href="route('selling')" :active="request()->routeIs('selling')"
                    wire:navigate />
                <x-menu-item title="Kulakan" icon="s-building-storefront" :href="route('wholesales')" :active="request()->routeIs('wholesales')"
                    wire:navigate />
                <x-menu-item title="Barang Masuk" icon="c-inbox-arrow-down" :href="route('update.products')" :active="request()->routeIs('update.products')"
                    wire:navigate />
                <x-menu-item title="Utang" icon="m-credit-card" :href="route('debts')" :active="request()->routeIs('debts')" wire:navigate />

            </x-menu-sub>
            <x-menu-sub title="Master Data" icon="s-square-3-stack-3d">
                <x-menu-item title="Barang" icon="m-archive-box-arrow-down" :href="route('products')" :active="request()->routeIs('products') ||
                    request()->routeIs('barcode.print') ||
                    request()->routeIs('duplikat.product')"
                    wire:navigate />
                <x-menu-item title="Pelanggan" icon="s-user-group" :href="route('customers')" :active="request()->routeIs('customers')"
                    wire:navigate />
                <x-menu-item title="Kategori Barang" icon="s-wallet" :href="route('categories')" :active="request()->routeIs('categories')"
                    wire:navigate />
                <x-menu-item title="Supplier" icon="m-users" :href="route('suppliers')" :active="request()->routeIs('suppliers')" wire:navigate />
            </x-menu-sub>
            <x-menu-item title="Laporan" icon="s-document-text" :href="route('reports')" :active="request()->routeIs('reports')" wire:navigate />

            {{-- User --}}
            @if ($user = auth()->user())
                <x-menu-separator />

                <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                    class="-mx-2 !-my-2 rounded">
                    <x-slot:avatar>
                        <x-button icon="o-user" class="btn-sm btn-circle btn-outline text-base-content"
                            link="{{ route('profile') }}" spinner />
                    </x-slot:avatar>
                    <x-slot:actions>
                        {{-- <label class="swap swap-rotate mr-3">
                            <!-- this hidden checkbox controls the state -->
                            <input type="checkbox" class="theme-controller" value="dim" />

                            <!-- sun icon -->
                            <svg class="swap-off h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                            </svg>

                            <!-- moon icon -->
                            <svg class="swap-on h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                            </svg>
                        </label> --}}
                        <livewire:actions.logout-component />
                    </x-slot:actions>
                </x-list-item>

                <x-menu-separator />
            @endif
        </x-menu>
    </x-slot:sidebar>
</nav>
