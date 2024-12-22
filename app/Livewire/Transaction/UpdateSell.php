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
    public $searchCustomer = '';


    public function render()
    {
        $this->customers = Customer::orderBy('name', 'asc')->get();

        return view('livewire.transaction.update-sell');
    }

    public function mount($id = null)
    {
        $transaction = Transaction::findOrFail($id);

        $this->transaction_id = $id;
        $this->customer_id = $transaction->customer_id;
        $this->searchCustomer = $transaction->customer_id;
        $this->payment_method = $transaction->payment_method;
        $this->total_price = number_format($transaction->total_price, 0, ',', '.');
        $this->total_paid = number_format($transaction->total_paid, 0, ',', '.');
        $this->change_due = number_format($transaction->change_due, 0, ',', '.');
        $this->utang = number_format($transaction->utang, 0, ',', '.');
        $this->status = $transaction->status;
        $this->date = $transaction->date->format('Y-m-d');
    }

    public function save()
    {
        $this->validate([
            'customer_id' => 'nullable|numeric',
            'payment_method' => 'string|max:255',

        ]);

        $this->total_price = str_replace('.', '', $this->total_price);
        $this->total_paid = str_replace('.', '', $this->total_paid);
        $this->change_due = str_replace('.', '', $this->change_due);
        $this->utang = str_replace('.', '', $this->utang);


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

    public function updatedTotalPrice()
    {
        $this->total_price = str_replace('.', '', $this->total_price);

        $this->total_price = number_format($this->total_price, 0, ',', '.');
    }

    public function updatedTotalPaid()
    {
        $this->total_paid = number_format($this->total_paid, 0, ',', '.');
    }

    public function updatedChangeDue()
    {
        $this->change_due = number_format($this->change_due, 0, ',', '.');
    }

    public function updatedUtang()
    {
        $this->utang = number_format($this->utang, 0, ',', '.');
    }

    public function updatedSearchCustomer()
    {
        $this->customers = Customer::where('id', 'like', '%' . $this->searchCustomer . '%')->get();

        if (empty($this->searchCustomer)) {
            $this->customers = [];
        }
    }
}
