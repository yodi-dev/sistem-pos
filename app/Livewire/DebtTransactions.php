<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class DebtTransactions extends Component
{
    public $transactions;

    public function mount()
    {
        $this->transactions = Transaction::where('payment_method', 'utang')
            ->with('customer')
            ->orderBy('customer_id')
            ->get();
    }

    public function render()
    {
        // dd($this->transactions);
        return view('livewire.debt-transactions')->layout('layouts.app');
    }
}
