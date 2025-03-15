<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;


#[Title('Halaman Produk | Habiba Store')]
class ProductManager extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $isModalSupplier = false;
    public $modalImport = false;
    public $Product;
    public $productId;
    public $selectedProduct;
    public $selectedSupplier;
    public $suppliers;
    public $assignedSuppliers = [];


    public function render()
    {
        $products = Product::with('units')->where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(10);

        return view('livewire.product.index', compact('products'));
    }

    public function openSupplierModal($productId)
    {
        $this->isModalSupplier = true;
        $this->selectedProduct = Product::find($productId);
        $this->suppliers = Supplier::all();
        $this->assignedSuppliers = $this->selectedProduct->suppliers;
    }

    public function assignSupplier()
    {
        if ($this->selectedProduct->suppliers()->where('supplier_id', $this->selectedSupplier)->exists()) {
            $this->closeModal();
            $this->dispatch('showToastError', 'Gagal menambahkan supplier!');

            return;
        }

        $this->selectedProduct->suppliers()->attach($this->selectedSupplier);
        $this->assignedSuppliers = $this->selectedProduct->suppliers;
        $this->closeModal();

        $this->dispatch('showToast', 'Supplier berhasil ditambahkan.');
    }

    public function removeSupplier($supplierId)
    {
        if (!$this->selectedProduct) {
            session()->flash('error', 'Produk belum dipilih.');
            return;
        }

        $this->selectedProduct->suppliers()->detach($supplierId);

        $this->assignedSuppliers = $this->selectedProduct->suppliers;

        $this->closeModal();
        $this->dispatch('showToast', 'Supplier berhasil dihapus.');
    }

    public function showDetails($productId)
    {
        $this->Product = Product::with('category')->find($productId);
        $this->isModalOpen = true;
    }

    public function import()
    {
        $this->modalImport = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->isModalSupplier = false;
        $this->reset(['isModalSupplier', 'selectedProduct', 'assignedSuppliers', 'selectedSupplier']);
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Produk berhasil dihapus.');
    }
}
