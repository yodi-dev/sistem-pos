<?php

namespace App\Livewire\Report;

use App\Models\DailyReport;
use Livewire\Component;

class ReportTable extends Component
{
    public $reports;

    public function render()
    {
        return view('livewire.report.report-table');
    }

    public function mount()
    {
        // Mengambil semua data laporan harian dan memformatnya
        $this->reports = DailyReport::all()->map(function ($report) {
            // Memformat angka agar mudah dibaca
            $report->formatted_total_income = number_format($report->total_income, 0, ',', '.');
            $report->formatted_total_outcome = number_format($report->total_outcome, 0, ',', '.');
            $report->formatted_balance = number_format($report->balance, 0, ',', '.');
            $report->formatted_savings = number_format($report->savings, 0, ',', '.');

            return $report;
        });
    }

    public function delete($id)
    {
        DailyReport::find($id)->delete();
        session()->flash('message', 'Berhasil hapus data laporan harian.');
        $this->mount();
    }
}
