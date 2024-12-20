<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Validation\Rule;

class DuplikatProduct extends Component
{
    public $categories;
    public $code, $name, $category_name, $purchase_price, $retail_price, $reseller_price, $agent_price, $distributor_price, $stock, $location, $supplier;

    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.product.duplikat-product');
    }

    public function mount($id = null)
    {
        $product = Product::findOrFail($id);

        $this->code = $product->code;
        $this->name = $product->name;
        $this->name .= " - copy";
        $this->category_name = $product->category;
        $this->purchase_price = $product->purchase_price;
        $this->retail_price = $product->retail_price;
        $this->reseller_price = $product->reseller_price;
        $this->agent_price = $product->agent_price;
        $this->distributor_price = $product->distributor_price;
        $this->stock = $product->stock;
        $this->location = $product->location;
        $this->supplier = $product->supplier;
    }

    public function save()
    {
        $this->validate([
            'code' => ['nullable', 'numeric', Rule::unique('products', 'code')],
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer',
        ], [
            'code.unique' => 'kode sudah ada',
        ]);

        Product::Create([
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
            'Product Created Successfully.'
        );

        $this->resetForm();

        redirect('products');
    }

    public function resetForm()
    {
        $this->product_id = null;
        $this->code = '';
        $this->name = '';
        $this->category_name = '';
        $this->purchase_price = '';
        $this->retail_price = '';
        $this->reseller_price = '';
        $this->agent_price = '';
        $this->distributor_price = '';
        $this->stock = '';
        $this->location = '';
        $this->supplier = '';
    }
}
