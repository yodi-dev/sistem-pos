<?php

namespace App\Livewire\Report;

use Mary\Traits\Toast;
use App\Models\Expense;
use Livewire\Component;
use App\Models\DailyReport;
use App\Models\Transaction;
use Livewire\Attributes\On;

class TemporaryReport extends Component
{
    use Toast;
    public $isModal = false;
    public $totalIncome = 0;
    public $totalOutcome = 0;
    public $savings = 0;
    public $balance = 0;
    public $addSavings = 0;
    public $notes;
    public $openingBalance = 0;
    public $openingSavings = 0;

    public function openModal()
    {
        $this->isModal = true;
    }

    public function render()
    {
        return view('livewire.report.temporary-report');
    }

    public function mount()
    {
        $reportDate = now()->format('Y-m-d');

        $this->openingBalance = DailyReport::where('report_date', $reportDate)->value('opening_balance') ?? 0;
        $this->openingSavings = DailyReport::where('report_date', $reportDate)->value('opening_savings') ?? 0;

        $this->totalIncome = Transaction::whereDate('created_at', $reportDate)->sum('total_price');
        $this->totalOutcome = Expense::whereDate('created_at', $reportDate)->sum('amount');

        $this->updateSavings();
        $this->updateBalance();
        $this->setFormat();
    }

    private function updateBalance()
    {
        $reportDate = now()->format('Y-m-d');

        $previousBalance = DailyReport::where('report_date', '<', $reportDate)
            ->orderBy('report_date', 'desc')
            ->value('balance') ?? 0;

        $currentBalance = $this->openingBalance + $previousBalance;
        $totalOutcome = $this->totalOutcome + $this->addSavings;
        $currentBalance -= $totalOutcome;
        $currentBalance += $this->totalIncome;
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
    }

    private function updateSavings()
    {
        $reportDate = now()->format('Y-m-d');

        $previousSavings = DailyReport::where('report_date', '<', $reportDate)
            ->orderBy('report_date', 'desc')
            ->value('savings') ?? null;

        $currentSavings = $this->openingSavings + $previousSavings;
        $this->savings = $currentSavings;
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

        $this->success('Berhasil membuat laporan', css: 'bg-neutral text-base-100 rounded-md');
        $this->dispatch('save-report');
        $this->setFormat();
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
        $this->success('Berhasil ubah total pemasukkan', css: 'bg-neutral text-base-100 rounded-md');
    }

    public function updatedTotalOutcome()
    {
        $this->inisiateFormat();
        $this->updateBalance();
        $this->setFormat();
        $this->success('Berhasil ubah total pengeluaran', css: 'bg-neutral text-base-100 rounded-md');
    }

    public function setAddSavings()
    {
        $this->inisiateFormat();
        $this->addSavings ? $this->addSavings = str_replace('.', '', $this->addSavings) : 0;
        $this->savings += $this->addSavings;

        $this->success('Berhasil tambah tabungan', css: 'bg-neutral text-base-100 rounded-md');
        $this->updateBalance();
        $this->setFormat();
        $this->addSavings = number_format($this->addSavings, 0, ',', '.');
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->isModal = false;
        $this->mount();
    }
}
