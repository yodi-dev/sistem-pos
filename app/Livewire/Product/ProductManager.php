<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;


#[Title('Halaman Produk | Yudis')]
class ProductManager extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $Product;
    public $productId;

    public function render()
    {
        $products = Product::with('units')->where('name', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.product.index', compact('products'));
    }


    public function showDetails($productId)
    {
        $this->Product = Product::with('category')->find($productId);
        $this->isModalOpen = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->isModalOpen = false;
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
