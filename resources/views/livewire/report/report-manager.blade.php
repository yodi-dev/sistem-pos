<div>
    <div class="mb-6">
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

        @livewire('report.temporary-report')
        <div class="divider"></div>
        @livewire('report.report-table')
    </div>

</div>
