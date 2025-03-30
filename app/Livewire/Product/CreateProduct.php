<?php

namespace App\Livewire\Product;

use Mary\Traits\Toast;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class CreateProduct extends Component
{
    use Toast;
    public $categories;
    public $code, $name, $category_id, $purchase_price, $retail_price, $wholesale_price, $agent_price, $reseller_price, $stock, $location;
    public $product_id;

    public $isEditing = false;

    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.product.create-product');
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->isEditing = true;

            $product = Product::findOrFail($id);
            $this->product_id = $id;
            $this->code = $product->code;
            $this->name = $product->name;
            $this->category_id = $product->category_id;
            $this->purchase_price = number_format($product->purchase_price, 0, ',', '.');
            $this->retail_price = number_format($product->retail_price, 0, ',', '.');
            $this->wholesale_price = number_format($product->wholesale_price, 0, ',', '.');
            $this->agent_price = number_format($product->agent_price, 0, ',', '.');
            $this->reseller_price = number_format($product->reseller_price, 0, ',', '.');
            $this->stock = $product->stock;
            $this->location = $product->location;
        }
    }

    public function save()
    {
        $this->validate([
            'code' => 'nullable|numeric',
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer',
            'purchase_price' => 'nullable|numeric',
            'retail_price' => 'nullable|numeric',
            'wholesale_price' => 'nullable|numeric',
            'agent_price' => 'nullable|numeric',
            'reseller_price' => 'nullable|numeric',
        ]);

        $this->purchase_price ? $this->purchase_price = str_replace('.', '', $this->purchase_price) : 0;
        $this->retail_price ? $this->retail_price = str_replace('.', '', $this->retail_price) : 0;
        $this->wholesale_price ? $this->wholesale_price = str_replace('.', '', $this->wholesale_price) : 0;
        $this->agent_price ? $this->agent_price = str_replace('.', '', $this->agent_price) : 0;
        $this->reseller_price ? $this->reseller_price = str_replace('.', '', $this->reseller_price) : 0;


        Product::updateOrCreate(['id' => $this->product_id], [
            'code' => $this->code,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'purchase_price' => $this->purchase_price,
            'retail_price' => $this->retail_price,
            'wholesale_price' => $this->wholesale_price,
            'agent_price' => $this->agent_price,
            'reseller_price' => $this->reseller_price,
            'stock' => $this->stock,
            'location' => $this->location,
        ]);


        $this->resetForm();

        redirect('products');
        $this->dispatch('saveProduct');
        $this->success($this->product_id ? 'Berhasil Perbarui Produk.' : 'Berhasil Menambahkan Produk.', css:'bg-neutral text-base-100 rounded-md');
    }

    public function resetForm()
    {
        $this->isEditing = false;
        $this->product_id = null;
        $this->code = '';
        $this->name = '';
        $this->category_id = '';
        $this->purchase_price = '';
        $this->retail_price = '';
        $this->wholesale_price = '';
        $this->agent_price = '';
        $this->reseller_price = '';
        $this->stock = '';
        $this->location = '';
    }

    public function updatedPurchasePrice()
    {
        $this->purchase_price = str_replace('.', '', $this->purchase_price);
        $this->purchase_price = number_format($this->purchase_price, 0, ',', '.');
    }

    public function updatedRetailPrice()
    {
        $this->retail_price = str_replace('.', '', $this->retail_price);
        $this->retail_price = number_format($this->retail_price, 0, ',', '.');
    }

    public function updatedResellerPrice()
    {
        $this->reseller_price = str_replace('.', '', $this->reseller_price);
        $this->reseller_price = number_format($this->reseller_price, 0, ',', '.');
    }

    public function updatedAgentPrice()
    {
        $this->agent_price = str_replace('.', '', $this->agent_price);
        $this->agent_price = number_format($this->agent_price, 0, ',', '.');
    }

    public function updatedWholesalePrice()
    {
        $this->wholesale_price = str_replace('.', '', $this->wholesale_price);
        $this->wholesale_price = number_format($this->wholesale_price, 0, ',', '.');
    }
}
