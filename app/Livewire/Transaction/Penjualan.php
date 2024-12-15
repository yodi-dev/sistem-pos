<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class Penjualan extends Component
{
    public $transactions;

    public function render()
    {
        return view('livewire.transaction.penjualan');
    }

    public function mount()
    {
        $transactions = Transaction::with('customer')->get();

        $this->transactions = $transactions;
    }
}
