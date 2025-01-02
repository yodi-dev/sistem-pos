<?php

namespace App\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use Livewire\Attributes\On;

class ExpenseManajer extends Component
{
    public $showCreateForm;

    public function render()
    {
        $expenses = Expense::latest()->paginate(10);

        return view('livewire.expense.expense-manajer', compact('expenses'));
    }

    #[On('hideForm')]
    public function hideCreateForm()
    {
        session()->flash('message', 'Pengeluaran berhasil disimpan!');
        $this->showCreateForm = false;
    }

    public function create()
    {
        $this->showCreateForm = true;
    }
}
