<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class CreateProduct extends Component
{
    public $categories;
    public $code, $name, $category_name, $purchase_price, $retail_price, $reseller_price, $agent_price, $distributor_price, $stock, $location, $supplier;
    public $product_id;


    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.product.create-product');
    }

    public function save()
    {
        $this->validate([
            'code' => 'nullable|numeric',
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer',
        ]);

        Product::updateOrCreate(['id' => $this->product_id], [
            'code' => $this->code,
            'name' => $this->name,
            'category' => $this->category_name,
            'purchase_price' => $this->purchase_price,
            'retail_price' => $this->retail_price,
            'reseller_price' => $this->reseller_price,
            'agent_price' => $this->agent_price,
            'distributor_price' => $this->distributor_price,
            'stock' => $this->stock,
            'location' => $this->location,
            'supplier' => $this->supplier,
        ]);

        session()->flash(
            'message',
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.'
        );

        redirect('products');
    }
}
