<?php

namespace App\Livewire\Report;

use App\Models\Expense;
use Livewire\Component;
use App\Models\DailyReport;
use App\Models\Transaction;

class TemporaryReport extends Component
{
    public $totalIncome = 0;
    public $totalOutcome = 0;
    public $savings = 0;
    public $balance = 0;

    public function render()
    {
        // $reportDate = now()->format('Y-m-d');

        // Data pemasukan
        // $totalIncome = Transaction::whereDate('created_at', $reportDate)->sum('total_price');

        // Data pengeluaran
        // $totalExpense = Expense::whereDate('created_at', $reportDate)->sum('amount');

        // Total outcome
        // $totalOutcome = $totalExpense + $this->savings;

        // Balance sementara
        // $previousBalance = DailyReport::where('report_date', '<', $reportDate)
        //     ->orderBy('report_date', 'desc')
        //     ->value('balance') ?? 0;

        // $balance = $previousBalance - $totalOutcome + $totalIncome;

        return view(
            'livewire.report.temporary-report'
            // , [
            //     'totalIncome' => $totalIncome,
            //     'totalOutcome' => $totalOutcome,
            //     'savings' => $this->savings,
            //     'balance' => $balance,
            // ]
        );
    }

    public function mount()
    {
        $reportDate = now()->format('Y-m-d');

        // Ambil data awal
        $this->totalIncome = number_format(Transaction::whereDate('created_at', $reportDate)->sum('total_price'), 0, ',', '.');
        $this->totalOutcome = number_format(Expense::whereDate('created_at', $reportDate)->sum('amount'), 0, ',', '.');
        $this->savings = 0; // Default savings 0
        $this->updateBalance();
    }


    private function updateBalance()
    {
        $reportDate = now()->format('Y-m-d');

        $previousBalance = DailyReport::where('report_date', '<', $reportDate)
            ->orderBy('report_date', 'desc')
            ->value('balance') ?? 0;
        $this->balance = $previousBalance - $this->totalOutcome - $this->savings + $this->totalIncome;
    }

    public function generateReport()
    {
        // Panggil fungsi generate laporan
        // Tambahkan logika dari sebelumnya
    }
}
