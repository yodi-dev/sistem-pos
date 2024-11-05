<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ProductManager extends Component
{
    use WithPagination;

    public $name, $price, $stock, $description, $product_id, $categories, $category_id;
    public $search = '';
    public $isOpen = false;
    public $isModalOpen = false;
    public $isModalSatuan = false;
    public $Product;
    public $productId;
    public $unitId;
    public $unit_name;
    public $quantity_per_unit;
    public $units = [];


    protected $rules = [
        'unit_name' => 'required|string|max:50',
        'quantity_per_unit' => 'required|integer|min:1',
    ];

    public function fillDefaultValues($name, $quantity)
    {
        $this->unit_name = $name;
        $this->quantity_per_unit = $quantity;
    }

    public function editUnit($productId)
    {
        // Ambil produk berdasarkan ID
        $this->Product = Product::find($productId);
        $this->productId = $this->Product->id;
        $this->units = $this->Product->units;

        // Emit event untuk membuka modal
        $this->isModalSatuan = true;
    }

    public function deleteUnit($unitId)
    {
        $unit = Unit::find($unitId);
        if ($unit) {
            $unit->delete();
            $this->units = $this->Product->units;
        }
    }


    public function resetForm()
    {
        $this->unitId = null;
        $this->unit_name = '';
        $this->quantity_per_unit = '';
    }

    public function saveUnit()
    {
        $this->validate();

        Unit::updateOrCreate(
            ['id' => $this->unitId],
            [
                'product_id' => $this->productId,
                'name' => $this->unit_name,
                'qty' => $this->quantity_per_unit,
            ]
        );

        $this->resetForm();
        $this->units = $this->Product->units;
    }

    public function render()
    {
        $products = Product::with('units')->where('name', 'like', '%' . $this->search . '%')->paginate(10);

        $this->categories = Category::all();
        return view('livewire.product.index', compact('products'))->layout('layouts.app');
    }

    public function showDetails($productId)
    {
        $this->Product = Product::with('category')->find($productId);
        $this->isModalOpen = true;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset halaman ke pertama setiap kali pencarian berubah
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isModalOpen = false;
        $this->isModalSatuan = false;
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

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
        ]);

        session()->flash(
            'message',
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->description = $product->description;

        $this->openModal();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully.');
    }
}
