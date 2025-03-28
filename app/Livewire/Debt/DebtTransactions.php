<?php

namespace App\Livewire\Debt;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Transaction;

class DebtTransactions extends Component
{
    use Toast;
    public $payment = [];

    public function render()
    {
        $transactions = Transaction::where('payment_method', 'utang')
            ->with('customer')
            ->orderBy('id', 'desc')
            ->where('debt_status', 'Belum Lunas')
            ->paginate(10);
        return view('livewire.debt.index', compact('transactions'));
    }

    public function payDebt($transactionId, $index)
    {
        $this->payment[$index]['amount'] = str_replace('.', '', $this->payment[$index]['amount']);
        $transaction = Transaction::find($transactionId);
        $transaction->debt -= $this->payment[$index]['amount'];

        if ($transaction->debt <= 0) {
            $transaction->debt = 0;
            $transaction->debt_status = 'Lunas';
        }
        $transaction->save();

        $this->payment[$index]['amount'] = '';

        $this->success('Berhasil melakukan pembayaran.', css:'bg-neutral text-base-100 rounded-md');
    }

    public function lunasi($transactionId)
    {
        $transaction = Transaction::find($transactionId);
        $transaction->debt = 0;
        $transaction->debt_status = 'Lunas';

        $transaction->save();

        $this->success('Berhasil melakukan pembayaran.', css:'bg-neutral text-base-100 rounded-md');
    }
}
