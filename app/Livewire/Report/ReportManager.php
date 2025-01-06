<?php

namespace App\Livewire\Report;

use App\Models\Expense;
use Livewire\Component;
use App\Models\DailyReport;
use App\Models\Transaction;

class ReportManager extends Component
{
    public function render()
    {
        return view('livewire.report.report-manager');
    }

    public function generateReport()
    {
        $reportDate = now()->format('Y-m-d');

        // Data pemasukan
        $totalIncome = Transaction::whereDate('created_at', $reportDate)->sum('total_price');

        // Data pengeluaran
        $totalExpense = Expense::whereDate('created_at', $reportDate)->sum('amount');

        // Tabungan (input manual oleh user)
        $savings = $this->savings ?? 0;

        // Total outcome
        $totalOutcome = $totalExpense + $savings;

        // Balance sebelumnya
        $previousBalance = DailyReport::where('report_date', '<', $reportDate)
            ->orderBy('report_date', 'desc')
            ->value('balance') ?? 0;

        // Balance akhir
        $balance = $previousBalance - $totalOutcome + $totalIncome;

        // Simpan laporan ke database
        DailyReport::updateOrCreate(
            ['report_date' => $reportDate],
            [
                'total_income' => $totalIncome,
                'total_outcome' => $totalOutcome,
                'savings' => $savings,
                'balance' => $balance,
                'notes' => 'Laporan otomatis di-generate'
            ]
        );

        session()->flash('message', 'Laporan harian berhasil digenerate!');
    }
}
