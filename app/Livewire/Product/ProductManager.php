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
        $this->suppliers = Supplier::all(); // Ambil semua supplier
        $this->assignedSuppliers = $this->selectedProduct->suppliers; // Ambil supplier yang sudah dimiliki
    }

    public function assignSupplier()
    {
        $data = $this->selectedProduct->suppliers()->attach($this->selectedSupplier);
        $this->assignedSuppliers = $this->selectedProduct->suppliers;
        $this->closeModal();

        session()->flash('message', 'Berhasil menambahkan supplier ke produk.');
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

    private function resetInputFields()
    {
        $this->name = '';
        $this->category_id = '';
        $this->price = '';
        $this->stock = '';
        $this->description = '';
        $this->product_id = '';
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Produk berhasil dihapus.');
    }
}
