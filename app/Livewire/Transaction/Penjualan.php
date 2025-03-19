<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;

class Penjualan extends Component
{
    use WithPagination;

    public function render()
    {
        $transactions = Transaction::with('customer')->orderBy('id', 'desc')->paginate(10);
        // dd($transactions);

        return view('livewire.transaction.penjualan', compact('transactions'));
    }

    public function delete($id)
    {
        Transaction::find($id)->delete();
        $this->dispatch('showToast', 'Berhasil menghapus data jual.');
    }
}
