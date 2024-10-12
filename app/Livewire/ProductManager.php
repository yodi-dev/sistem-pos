<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductManager extends Component
{
    public $products, $name, $price, $stock, $description, $product_id;
    public $isOpen = 0;

    public function render()
    {
        $this->products = Product::all();
        return view('livewire.product-manager')->layout('layouts.app');
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
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->price = '';
        $this->stock = '';
        $this->description = '';
        $this->product_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
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
