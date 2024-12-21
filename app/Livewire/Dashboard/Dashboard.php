<?php

namespace App\Livewire\Dashboard;

use App\Models\Kulakan;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $minimum = 0;
    public $cart = [];

    public function render()
    {
        $products = Product::where('stock', '<=', $this->minimum)->paginate(50);
        return view('livewire.dashboard.dashboard', compact('products'));
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
