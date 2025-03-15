<?php

namespace App\Livewire\Report;

use Livewire\Component;
use App\Models\DailyReport;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportTable extends Component
{
    public $reports;
    public $incomeCash;
    public $incomeQRIS;

    public function render()
    {
        return view('livewire.report.report-table');
    }

    #[On('save-report')]
    public function mount()
    {
        $today = now()->toDateString();
        $this->incomeCash = Transaction::where('payment_method', 'tunai')->whereDate('created_at', $today)->sum('total_paid');
        $this->incomeQRIS = Transaction::where('payment_method', 'qris')->whereDate('created_at', $today)->sum('total_paid');

        $this->incomeCash = number_format($this->incomeCash, 0, ',', '.');
        $this->incomeQRIS = number_format($this->incomeQRIS, 0, ',', '.');

        $this->reports = DailyReport::all()->map(function ($report) {
            $report->formatted_total_income = number_format($report->total_income, 0, ',', '.');
            $report->formatted_total_outcome = number_format($report->total_outcome, 0, ',', '.');
            $report->formatted_balance = number_format($report->balance, 0, ',', '.');
            $report->formatted_opening_balance = number_format($report->opening_balance, 0, ',', '.');
            $report->formatted_savings = number_format($report->savings, 0, ',', '.');

            return $report;
        });
    }

    public function printPdf()
    {
        $reports =
            DailyReport::all()->map(function ($report) {
                $report->formatted_total_income = number_format($report->total_income, 0, ',', '.');
                $report->formatted_total_outcome = number_format($report->total_outcome, 0, ',', '.');
                $report->formatted_balance = number_format($report->balance, 0, ',', '.');
                $report->formatted_opening_balance = number_format($report->opening_balance, 0, ',', '.');
                $report->formatted_savings = number_format($report->savings, 0, ',', '.');

                return $report;
            });

        $pdf = Pdf::loadView('daily_report.print-report', compact('reports'))
            ->setPaper('a4', 'portrait');

        $this->mount();

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'laporan-harian-' . now()->format('Y-m-d') . '.pdf'
        );
    }
}
