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
    public $openingBalance = 0;
    public $openingSavings = 0;
    public $addSavings = 0;
    public $tes;

    public function render()
    {
        return view('livewire.report.temporary-report');
    }

    public function mount()
    {
        $reportDate = now()->format('Y-m-d');

        // Ambil data saldo awal dari daily_reports
        $this->openingBalance = DailyReport::where('report_date', $reportDate)->value('opening_balance') ?? 0;
        $this->openingSavings = DailyReport::where('report_date', $reportDate)->value('opening_savings') ?? 0;

        // Ambil data income dan outcome
        $this->totalIncome = Transaction::whereDate('created_at', $reportDate)->sum('total_price');
        $this->totalOutcome = Expense::whereDate('created_at', $reportDate)->sum('amount');

        // Perbarui balance dengan memperhitungkan saldo awal
        $this->updateBalance();

        $this->updateSavings();
    }

    private function updateBalance()
    {
        $reportDate = now()->format('Y-m-d');

        // Ambil saldo sebelumnya (jika ada)
        $previousBalance = DailyReport::where('report_date', '<', $reportDate)
            ->orderBy('report_date', 'desc')
            ->value('balance') ?? 0;

        // Hitung balance
        $currentBalance = $this->openingBalance + $previousBalance - $this->totalOutcome - $this->savings + $this->totalIncome;
        $this->balance = number_format($currentBalance, 0, ',', '.');
        $this->totalIncome = number_format($this->totalIncome, 0, ',', '.');
        $this->totalOutcome = number_format($this->totalOutcome, 0, ',', '.');
        $this->openingBalance = number_format($this->openingBalance, 0, ',', '.');
    }

    private function updateSavings()
    {
        $reportDate = now()->format('Y-m-d');

        // Ambil saldo sebelumnya (jika ada)
        $previousSavings = DailyReport::where('report_date', '<', $reportDate)
            ->orderBy('report_date', 'desc')
            ->value('savings') ?? 0;

        // Hitung balance
        $currentSavings = $this->openingSavings + $previousSavings;

        $this->savings = number_format($currentSavings, 0, ',', '.');
        $this->openingSavings = number_format($this->openingSavings, 0, ',', '.');
    }

    public function setOpeningBalance()
    {
        $reportDate = now()->format('Y-m-d');

        $this->openingBalance ? $this->openingBalance = str_replace('.', '', $this->openingBalance) : 0;

        DailyReport::updateOrCreate(
            ['report_date' => $reportDate],
            [
                'opening_balance' => $this->openingBalance,
                'total_income' => 0,
                'total_outcome' => 0,
                'savings' => 0,
                'balance' => 0,
            ]
        );

        session()->flash('message', 'Saldo awal berhasil disimpan.');
        $this->reset('openingBalance'); // Reset properti saldo awal
        $this->mount();
    }

    public function setOpeningSavings()
    {
        $reportDate = now()->format('Y-m-d');

        $this->openingSavings ? $this->openingSavings = str_replace('.', '', $this->openingSavings) : 0;

        DailyReport::updateOrCreate(
            ['report_date' => $reportDate],
            [
                'opening_savings' => $this->openingSavings,
                'total_income' => 0,
                'total_outcome' => 0,
                'savings' => 0,
                'balance' => 0,
            ]
        );

        session()->flash('message', 'Tabungan awal berhasil disimpan.');
        $this->reset('openingSavings');
        $this->mount();
    }

    public function generateReport()
    {
        $dailyReport = DailyReport::where('report_date', now()->toDateString())->first();

        if (!$dailyReport) {
            return 'Laporan untuk hari ini belum ada.';
        }

        return [
            'report_date' => $dailyReport->report_date,
            'opening_balance' => $dailyReport->opening_balance,
            'total_income' => $dailyReport->total_income,
            'total_outcome' => $dailyReport->total_outcome,
            'balance' => $dailyReport->balance,
        ];
    }

    public function updatedTotalIncome()
    {
        $this->totalIncome = str_replace('.', '', $this->totalIncome);
        $this->totalOutcome = str_replace('.', '', $this->totalOutcome);
        $this->savings = str_replace('.', '', $this->savings);
        $this->openingBalance = str_replace('.', '', $this->openingBalance);
        $this->updateBalance();
        session()->flash('message', 'Total pemasukkan berhasil diubah.');
    }

    public function updatedTotalOutcome()
    {
        $this->totalIncome = str_replace('.', '', $this->totalIncome);
        $this->totalOutcome = str_replace('.', '', $this->totalOutcome);
        $this->savings = str_replace('.', '', $this->savings);
        $this->openingBalance = str_replace('.', '', $this->openingBalance);
        $this->updateBalance();
        session()->flash('message', 'Total pengeluaran berhasil diubah.');
    }
}
