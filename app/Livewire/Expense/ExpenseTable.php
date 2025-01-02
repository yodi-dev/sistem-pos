<?php

namespace App\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseTable extends Component
{
    public function render()
    {
        return view('livewire.expense.expense-table');
    }
}
