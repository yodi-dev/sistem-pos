<?php

namespace App\Livewire\Transaction;

use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;

class Penjualan extends Component
{
    use WithPagination;
    use Toast;

    public function render()
    {
        $transactions = Transaction::with('customer')->orderBy('id', 'desc')->paginate(10);

        return view('livewire.transaction.penjualan', compact('transactions'));
    }

    public function delete($id)
    {
        Transaction::find($id)->delete();

        $this->success('Berhasil menghapus data jual.', css: 'bg-neutral text-base-100 rounded-md');
    }
}
