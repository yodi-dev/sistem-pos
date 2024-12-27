<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;

class SupplierManager extends Component
{
    public $suppliers;
    public $supplier_id;
    public $name;
    public $isModalOpen;

    public function render()
    {
        $this->suppliers = Supplier::orderBy('id', 'desc')->get();
        return view('livewire.supplier.supplier-manager');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->supplier_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Supplier::updateOrCreate(['id' => $this->supplier_id], [
            'name' => $this->name,
        ]);

        session()->flash('message', $this->supplier_id ? 'Berhasil memperbarui data supplier.' : 'Berhasil membuat data supplier.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplier_id = $id;
        $this->name = $supplier->name;

        $this->openModal();
    }

    public function delete($id)
    {
        Supplier::find($id)->delete();
        session()->flash('message', 'Berhasil menghapus data supplier.');
    }
}
