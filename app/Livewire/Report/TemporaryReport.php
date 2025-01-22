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
    public $notes;

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
        $this->updateSavings();
        $this->updateBalance();
        $this->setFormat();
    }

    private function updateBalance()
    {
        $reportDate = now()->format('Y-m-d');

        // Ambil saldo sebelumnya (jika ada)
        $previousBalance = DailyReport::where('report_date', '<', $reportDate)
            ->orderBy('report_date', 'desc')
            ->value('balance') ?? 0;

        // saldo sekarang
        $currentBalance = $this->openingBalance + $previousBalance;
        // total pengeluaran
        $totalOutcome = $this->totalOutcome - $this->openingSavings - $this->addSavings;
        // saldo sekarang dikurangi total pengeluaran
        $currentBalance -= $totalOutcome;
        // saldo sekarang ditambah total pemasukkan
        $currentBalance += $this->totalIncome;
        // update saldo dengan saldo sekarang
        $this->balance = $currentBalance;
    }

    private function setFormat()
    {
        $this->totalIncome = number_format($this->totalIncome, 0, ',', '.');
        $this->totalOutcome = number_format($this->totalOutcome, 0, ',', '.');
        $this->openingBalance = number_format($this->openingBalance, 0, ',', '.');
        $this->savings = number_format($this->savings, 0, ',', '.');
        $this->balance = number_format($this->balance, 0, ',', '.');
        $this->openingSavings = number_format($this->openingSavings, 0, ',', '.');
        $this->addSavings = number_format($this->addSavings, 0, ',', '.');
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

        $this->savings = $currentSavings;
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
        $this->mount();
    }

    public function generateReport()
    {
        $this->inisiateFormat();
        $reportDate = now()->format('Y-m-d');

        DailyReport::updateOrCreate(
            ['report_date' => $reportDate],
            [
                'total_income' => $this->totalIncome,
                'total_outcome' => $this->totalOutcome,
                'opening_savings' => $this->openingSavings,
                'savings' => $this->savings,
                'opening_balance' => $this->openingBalance,
                'balance' => $this->balance,
                'notes' => $this->notes,
            ]
        );

        session(['daily_report_saved' => true]);
        $this->dispatch("daily_report_saved");
    }

    private function inisiateFormat()
    {
        $this->totalIncome = str_replace('.', '', $this->totalIncome);
        $this->totalOutcome = str_replace('.', '', $this->totalOutcome);
        $this->savings = str_replace('.', '', $this->savings);
        $this->openingBalance = str_replace('.', '', $this->openingBalance);
        $this->openingSavings = str_replace('.', '', $this->openingSavings);
        $this->balance = str_replace('.', '', $this->balance);
    }

    public function updatedTotalIncome()
    {
        $this->inisiateFormat();
        $this->updateBalance();
        $this->setFormat();
        session()->flash('message', 'Total pemasukkan berhasil diubah.');
    }

    public function updatedTotalOutcome()
    {
        $this->inisiateFormat();
        $this->updateBalance();
        $this->setFormat();
        session()->flash('message', 'Total pengeluaran berhasil diubah.');
    }

    public function setAddSavings()
    {
        $this->inisiateFormat();
        $this->addSavings ? $this->addSavings = str_replace('.', '', $this->addSavings) : 0;
        $this->savings += $this->addSavings;

        session()->flash('message', 'Berhasil tambah tabungan.');
        $this->updateBalance();
        $this->setFormat();
    }
}
