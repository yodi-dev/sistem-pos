<?php

namespace App\Livewire\Debt;

use Livewire\Component;
use App\Models\Transaction;

class DebtTransactions extends Component
{
    public $payment = [];

    public function render()
    {
        $transactions = Transaction::where('payment_method', 'utang')
            ->with('customer')
            ->orderBy('id', 'desc')
            ->where('status', 'Belum Lunas')
            ->paginate(10);
        return view('livewire.debt.index', compact('transactions'));
    }

    public function payDebt($transactionId, $index)
    {
        // Temukan transaksi dan kurangi total price
        $transaction = Transaction::find($transactionId);
        $transaction->utang -= $this->payment[$index]['amount'];

        // Update status jika utang sudah lunas
        if ($transaction->utang <= 0) {
            $transaction->utang = 0;
            $transaction->status = 'Lunas';
        }
        $transaction->save();

        $this->payment[$index]['amount'] = '';

        session()->flash('message', 'Pembayaran berhasil.');
    }
}
