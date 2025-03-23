<?php

namespace App\Livewire\Report;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\DailyReport;

class SetBalance extends Component
{
    use Toast;

    public $openingBalance = 0;
    public $openingQris = 0;
    public $openingSavings = 0;

    public function mount()
    {
        $reportDate = now()->format('Y-m-d');

        $openingBalance = DailyReport::where('report_date', $reportDate)->value('opening_balance') ?? 0;
        $openingQris = DailyReport::where('report_date', $reportDate)->value('opening_qris') ?? 0;
        $openingSavings = DailyReport::where('report_date', $reportDate)->value('opening_savings') ?? 0;

        $this->openingBalance = number_format($openingBalance, 0, ',', '.');
        $this->openingQris = number_format($openingQris, 0, ',', '.');
        $this->openingSavings = number_format($openingSavings, 0, ',', '.');
    }

    public function setOpeningBalance()
    {
        $reportDate = now()->format('Y-m-d');

        $this->openingBalance ? $this->openingBalance = str_replace('.', '', $this->openingBalance) : 0;

        $report = DailyReport::firstOrCreate(
            ['report_date' => $reportDate],
            [
                'qris_income' => 0,
                'total_income' => 0,
                'total_outcome' => 0,
                'opening_savings' => 0,
                'savings' => 0,
                'opening_balance' => $this->openingBalance,
                'opening_qris' => 0,
                'qris_balance' => 0,
                'balance' => 0,
            ]
        );
        $report->update(['opening_balance' => $this->openingBalance]);

        $this->closeModal();
        $this->success('Berhasil simpan saldo awal', css: 'bg-neutral text-base-100 rounded-md');
    }

    public function setQrisBalance()
    {
        $reportDate = now()->format('Y-m-d');

        $this->openingQris ? $this->openingQris = str_replace('.', '', $this->openingQris) : 0;

        $report = DailyReport::firstOrCreate(
            ['report_date' => $reportDate],
            [
                'qris_income' => 0,
                'total_income' => 0,
                'total_outcome' => 0,
                'opening_savings' => 0,
                'savings' => 0,
                'opening_balance' => 0,
                'qris_balance' => 0,
                'opening_qris' => $this->openingQris,
                'balance' => 0,
            ]
        );
        $report->update(['opening_qris' => $this->openingQris]);

        $this->closeModal();
        $this->success('Berhasil simpan saldo awal QRIS', css: 'bg-neutral text-base-100 rounded-md');
    }

    public function setOpeningSavings()
    {
        $reportDate = now()->format('Y-m-d');

        $this->openingSavings ? $this->openingSavings = str_replace('.', '', $this->openingSavings) : 0;

        $report = DailyReport::firstOrCreate(
            ['report_date' => $reportDate],
            [
                'qris_income' => 0,
                'total_income' => 0,
                'total_outcome' => 0,
                'opening_savings' => $this->openingSavings,
                'savings' => 0,
                'opening_balance' => 0,
                'opening_qris' => 0,
                'qris_balance' => 0,
                'balance' => 0,
            ]
        );
        $report->update(['opening_savings' => $this->openingSavings]);

        $this->success('berhasil simpan tabungan awal', css: 'bg-neutral text-base-100 rounded-md');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.report.set-balance');
    }
}
