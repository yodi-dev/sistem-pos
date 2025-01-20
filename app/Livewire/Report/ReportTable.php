<?php

namespace App\Livewire\Report;

use App\Models\DailyReport;
use Livewire\Component;

class ReportTable extends Component
{
    public $reports;

    public function render()
    {
        $this->reports = DailyReport::all();
        return view('livewire.report.report-table');
    }
}
