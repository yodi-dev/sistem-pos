<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Penjualan extends Component
{
    use WithPagination;

    public function render()
    {
        $transactions = Transaction::with('customer')->paginate(10);

        return view('livewire.transaction.penjualan', compact('transactions'));
    }

    public function delete($id)
    {
        Transaction::find($id)->delete();
        session()->flash('message', 'Transaction Deleted Successfully.');
    }
}
