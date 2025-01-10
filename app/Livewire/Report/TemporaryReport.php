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
    public $openingBalance;

    public function render()
    {
        return view('livewire.report.temporary-report');
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

    public function setOpeningBalance()
    {
        DailyReport::updateOrCreate(
            ['report_date' => now()->toDateString()],
            [
                'opening_balance' => $this->openingBalance,
                'total_income' => 0,
                'total_outcome' => 0,
                'savings' => 0,
                'balance' => 0,
            ]
        );

        session()->flash('message', 'Saldo awal berhasil disimpan.');
    }


    private function updateBalance()
    {
        $reportDate = now()->format('Y-m-d');

        $this->totalIncome = str_replace('.', '', $this->totalIncome);
        $this->totalOutcome = str_replace('.', '', $this->totalOutcome);

        $previousBalance = DailyReport::where('report_date', '<', $reportDate)
            ->orderBy('report_date', 'desc')
            ->value('balance') ?? 0;

        $this->balance = number_format($previousBalance - $this->totalOutcome - $this->savings + $this->totalIncome, 0, ',', '.');

        $this->totalOutcome = number_format($this->totalOutcome, 0, ',', '.');
        $this->totalIncome = number_format($this->totalIncome, 0, ',', '.');
    }

    public function generateReport()
    {
        // Panggil fungsi generate laporan
        // Tambahkan logika dari sebelumnya
    }

    public function updatedTotalIncome()
    {
        $this->totalIncome = str_replace('.', '', $this->totalIncome);
        $this->totalIncome = number_format($this->totalIncome, 0, ',', '.');
        $this->updateBalance();
    }

    public function updatedTotalOutcome()
    {
        $this->totalOutcome = str_replace('.', '', $this->totalOutcome);
        $this->totalOutcome = number_format($this->totalOutcome, 0, ',', '.');
        $this->updateBalance();
    }
}
