<div>
    <div class="mb-6">
        @if (session('daily_report_saved'))
            @livewire('report.report-table')
        @else
            @livewire('report.temporary-report')
            <div class="divider"></div>
            @livewire('report.report-table')
        @endif
    </div>

</div>
