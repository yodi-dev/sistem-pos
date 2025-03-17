<?php

namespace App\Livewire\Expense;

use Mary\Traits\Toast;
use App\Models\Expense;
use Livewire\Component;
use Livewire\Attributes\On;

class ExpenseManajer extends Component
{
    use Toast;

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
        $this->success('Berhasil menyimpan pengeluaran.', css: 'bg-neutral text-base-100 rounded-md');
        $this->showForm = false;
    }

    #[On('closeModal')]
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
        $this->success('Berhasil menghapus data pengeluaran.', css: 'bg-neutral text-base-100 rounded-md');
    }
}
