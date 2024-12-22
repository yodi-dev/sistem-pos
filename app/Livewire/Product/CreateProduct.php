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

    // edit produk
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
            $this->category_name = $product->category;
            $this->purchase_price = number_format($product->purchase_price, 0, ',', '.');
            $this->retail_price = number_format($product->retail_price, 0, ',', '.');
            $this->reseller_price = number_format($product->reseller_price, 0, ',', '.');
            $this->agent_price = number_format($product->agent_price, 0, ',', '.');
            $this->distributor_price = number_format($product->distributor_price, 0, ',', '.');
            $this->stock = $product->stock;
            $this->location = $product->location;
            $this->supplier = $product->supplier;
        }
    }

    public function save()
    {
        $this->validate([
            'code' => 'nullable|numeric',
            'name' => 'required|string|max:255',
            'stock' => 'nullable|integer',
        ]);

        $this->purchase_price = str_replace('.', '', $this->purchase_price);
        $this->retail_price = str_replace('.', '', $this->retail_price);
        $this->reseller_price = str_replace('.', '', $this->reseller_price);
        $this->agent_price = str_replace('.', '', $this->agent_price);
        $this->distributor_price = str_replace('.', '', $this->distributor_price);


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

        $this->resetForm();

        redirect('products');
    }

    public function resetForm()
    {
        $this->isEditing = false;
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

    public function updatedDistributorPrice()
    {
        $this->distributor_price = str_replace('.', '', $this->distributor_price);

        $this->distributor_price = number_format($this->distributor_price, 0, ',', '.');
    }
}
