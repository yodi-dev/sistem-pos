<?php

namespace App\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseForm extends Component
{
    public $date, $expense, $amount, $note;
    protected $listeners = ['hideForm'];

    protected $rules = [
        'date' => 'required|date',
        'expense' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'note' => 'nullable|string',
    ];

    public function render()
    {
        return view('livewire.expense.expense-form');
    }

    public function mount()
    {
        $this->date = now()->toDateString(); // Format tanggal yang diinginkan: YYYY-MM-DD
    }

    public function saveExpense()
    {
        $this->validate();

        Expense::create([
            'date' => $this->date,
            'expense' => $this->expense,
            'amount' => $this->amount,
            'note' => $this->note,
        ]);

        $this->reset();
        $this->dispatch('hideForm');
    }
}
