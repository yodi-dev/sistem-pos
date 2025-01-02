<?php

namespace App\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseForm extends Component
{
    public $expenseId, $date, $expense, $amount, $note;

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

    public function mount($expenseId = null)
    {
        if ($expenseId) {
            $expense = Expense::findOrFail($expenseId);
            $this->expenseId = $expense->id;
            $this->date = $expense->date;
            $this->expense = $expense->expense;
            $this->amount = number_format($expense->amount, 0, ',', '.');
            $this->note = $expense->note;
        } else {
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        $this->date = now()->toDateString(); // Format tanggal yang diinginkan: YYYY-MM-DD
        $this->expense = '';
        $this->amount = '';
        $this->note = '';
    }

    public function save()
    {
        $this->validate();

        if ($this->expenseId) {
        }
        $this->amount = str_replace('.', '', $this->amount);

        Expense::updateOrCreate(
            ['id' => $this->expenseId],
            [
                'date' => $this->date,
                'expense' => $this->expense,
                'amount' => $this->amount,
                'note' => $this->note,
            ]
        );

        $this->dispatch('saveExpense');
    }

    public function closeModal()
    {
        $this->dispatch('closeForm');
    }
}
