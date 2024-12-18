<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Transaction;

class UpdateSell extends Component
{
    public $customers;
    public $customer_id, $payment_method, $total_price, $total_paid, $change_due, $utang, $status, $date;
    public $transaction_id;

    public function render()
    {
        $this->customers = Customer::all();

        return view('livewire.transaction.update-sell');
    }

    public function mount($id = null)
    {
        $transaction = Transaction::findOrFail($id);

        $this->transaction_id = $id;
        $this->customer_id = $transaction->customer_id;
        $this->payment_method = $transaction->payment_method;
        $this->total_price = $transaction->total_price;
        $this->total_paid = $transaction->total_paid;
        $this->change_due = $transaction->change_due;
        $this->utang = $transaction->utang;
        $this->status = $transaction->status;
        $this->date = $transaction->date->format('Y-m-d');
    }

    public function save()
    {
        $this->validate([
            'customer_id' => 'nullable|numeric',
            'payment_method' => 'string|max:255',

        ]);

        Transaction::where('id', $this->transaction_id)->update([
            'customer_id' => $this->customer_id,
            'payment_method' => $this->payment_method,
            'total_price' => $this->total_price,
            'total_paid' => $this->total_paid,
            'change_due' => $this->change_due,
            'utang' => $this->utang,
            'status' => $this->status,
            'date' => $this->date,
        ]);

        session()->flash('message', 'Transakasi berhasil diperbarui.');

        $this->resetForm();

        redirect('selling');
    }

    public function resetForm()
    {
        $this->transaction_id = null;
        $this->customer_id = '';
        $this->payment_method = '';
        $this->total_price = '';
        $this->total_paid = '';
        $this->change_due = '';
        $this->utang = '';
        $this->status = '';
        $this->date = '';
    }
}
