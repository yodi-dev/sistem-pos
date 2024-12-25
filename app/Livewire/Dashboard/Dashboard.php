<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Kulakan;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;

class Dashboard extends Component
{
    public $minimum = null;
    public $cart = [];
    public $categories;
    public $suppliers;
    public $category = '';
    public $supplier = '';

    public function render()
    {
        $products = Product::query();

        if ($this->minimum) {
            $products->where('stock', '<=', $this->minimum);
        } else
        if ($this->category) {
            $products->whereHas('category', function ($query) {
                $query->where('name', $this->category);
            });
        } else
        if ($this->supplier) {
            $products->whereHas('suppliers', function ($query) {
                $query->where('name', $this->supplier);
            });
        }

        $products = $products->paginate(20);

        return view('livewire.dashboard.dashboard', compact('products'));
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->suppliers = Supplier::all();
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $index = collect($this->cart)->search(fn($item) => $item['id'] === $product->id);

            if ($index !== false) {
                $this->cart[$index]['quantity'] += 1;
            } else {
                $this->cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => 1,
                ];
            }
        }
    }

    public function store()
    {
        foreach ($this->cart as $item) {
            Kulakan::create([
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'supplier' => $item['supplier'],
            ]);

            // mengurangi stok produk
            $product = Product::find($item['id']);
            $product->stock += $item['quantity'];
            $product->save();
        }

        $this->addError('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
