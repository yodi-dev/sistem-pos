<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Kulakan;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Wholesale;
use Livewire\Component;

class Dashboard extends Component
{
    public $minimum = null;
    public $cart = [];
    public $groupedCart;
    public $categories;
    public $suppliers;
    public $category = '';
    public $supplier = '';
    public $units;


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
        $product = Product::with(['suppliers', 'units'])->find($productId);

        if ($product) {
            $unit = $product->units->first();
            $defaultUnit = $unit ? $unit->id : '1';

            $supplier = $product->suppliers()->first();

            $index = collect($this->cart)->search(fn($item) => $item['id'] === $product->id && $item['supplier_id'] === $supplier->id);

            if ($index !== false) {
                $this->cart[$index]['quantity'] += 1;
            } else {
                $this->cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'supplier_id' => $supplier->id,
                    'supplier_name' => $supplier->name,
                    'units' => $product->units,
                    'unit' => $defaultUnit,
                    'unit_name' => $unit->name,
                    'multiplier' => $unit->multiplier,
                ];
            }

            $this->updateGroupedCart();
        }
    }

    public function updateGroupedCart()
    {
        $this->groupedCart = collect($this->cart)->groupBy('supplier_name');
    }

    public function store()
    {
        foreach ($this->groupedCart as $supplierId => $items) {
            // Simpan wholesale
            $wholesale = Wholesale::create([
                'supplier_id' => $supplierId,
                'date' => now(),
            ]);

            foreach ($items as $item) {
                $wholesale->items()->create([
                    'product_id' => $item['id'],
                    'unit_id' => $item['unit_id'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit_name'],
                    'total_stock' => $item['quantity'] * $item['multiplier'], // Hitung stok total
                ]);
            }
        }

        foreach ($this->cart as $item) {
            Wholesale::create([
                'product_id' => $item['id'],
                'supplier' => $item['supplier'],
            ]);

            // mengurangi stok produk
            $product = Product::find($item['id']);
            $product->stock += $item['quantity'];
            $product->save();
        }

        $this->addError('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }

    public function saveWholesale()
    {



        $this->cart = [];
    }
}
