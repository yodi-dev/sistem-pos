<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Validation\Rule;

class DuplikatProduct extends Component
{
    public $categories;
    public $code, $name, $category_id, $purchase_price, $retail_price, $reseller_price, $agent_price, $wholesale_price, $stock, $location;

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
        $this->category_id = $product->category->id ?? '';
        $this->purchase_price = number_format($product->purchase_price, 0, ',', '.');
        $this->retail_price = number_format($product->retail_price, 0, ',', '.');
        $this->wholesale_price = number_format($product->wholesale_price, 0, ',', '.');
        $this->agent_price = number_format($product->agent_price, 0, ',', '.');
        $this->reseller_price = number_format($product->reseller_price, 0, ',', '.');
        $this->stock = $product->stock;
        $this->location = $product->location;
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

        $this->purchase_price ? $this->purchase_price = str_replace('.', '', $this->purchase_price) : 0;
        $this->retail_price ? $this->retail_price = str_replace('.', '', $this->retail_price) : 0;
        $this->wholesale_price ? $this->wholesale_price = str_replace('.', '', $this->wholesale_price) : 0;
        $this->agent_price ? $this->agent_price = str_replace('.', '', $this->agent_price) : 0;
        $this->reseller_price ? $this->reseller_price = str_replace('.', '', $this->reseller_price) : 0;

        Product::Create([
            'code' => $this->code,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'purchase_price' => $this->purchase_price,
            'retail_price' => $this->retail_price,
            'reseller_price' => $this->reseller_price,
            'agent_price' => $this->agent_price,
            'wholesale_price' => $this->wholesale_price,
            'stock' => $this->stock,
            'location' => $this->location,
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
        $this->code = '';
        $this->name = '';
        $this->category_id = '';
        $this->purchase_price = '';
        $this->retail_price = '';
        $this->reseller_price = '';
        $this->agent_price = '';
        $this->wholesale_price = '';
        $this->stock = '';
        $this->location = '';
    }
}
