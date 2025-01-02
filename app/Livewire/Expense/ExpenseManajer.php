<?php

namespace App\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use Livewire\Attributes\On;

class ExpenseManajer extends Component
{
    public $showForm;
    public $selectedExpenseId = null;

    public function render()
    {
        $expenses = Expense::latest()->paginate(10);

        return view('livewire.expense.expense-manajer', compact('expenses'));
    }

    #[On('saveExpense')]
    public function hideCreateForm()
    {
        session()->flash('message', 'Berhasil menyimpan pengeluaran!');
        $this->showForm = false;
    }

    #[On('closeForm')]
    public function resetForm()
    {
        $this->showForm = false;
        $this->selectedExpenseId = null;
    }

    public function create()
    {
        $this->selectedExpenseId = null;
        $this->showForm = true;
    }

    public function edit($id)
    {
        $this->selectedExpenseId = $id;
        $this->showForm = true;
    }

    public function delete($id)
    {
        Expense::find($id)->delete();
        session()->flash('message', 'Berhasil menghapus data pengeluaran.');
    }
}
