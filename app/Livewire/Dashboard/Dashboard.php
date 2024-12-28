<?php

namespace App\Livewire\Dashboard;

use App\Models\Kulakan;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Wholesale;
use Livewire\Attributes\On;

class Dashboard extends Component
{
    public $minimum = null;
    public $cart = [];
    public $groupedCart;
    public $categories;
    public $suppliers;
    public $chooseSuppliers;
    public $category = '';
    public $supplier = '';
    public $supplierId;
    public $selectedProduct;
    public $selectedSupplier;
    public $units;
    public $modalSupplier = false;

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

    public function selectProduct($productId)
    {
        $product = Product::with('suppliers')->find($productId);
        // dd($product->suppliers->count());

        if ($product->suppliers->isEmpty()) {
            // Jika tidak ada supplier, tampilkan modal
            $this->chooseSuppliers = Supplier::all();
            $this->selectedProduct = $productId;
            $this->modalSupplier = true;
        } else if ($product->suppliers->count() > 1) {
            // Jika tidak ada supplier, tampilkan modal
            $this->chooseSuppliers = $product->suppliers;
            $this->selectedProduct = $productId;
            $this->modalSupplier = true;
        } else {
            // Langsung masukkan ke cart
            $this->addToCart($productId);
        }
    }

    public function addToCart($productId)
    {
        $product = Product::with(['suppliers', 'units'])->find($productId);

        if ($product) {
            $unit = $product->units->first();
            $supplier = $product->suppliers->first();

            if ($unit) {
                $unitId = $unit->id;
                $unitName = $unit->name;
                $unitMultiplier = $unit->multiplier;
            } else {
                $unitId = '';
                $unitName = '';
                $unitMultiplier = '';
            }

            $index = collect($this->cart)->search(fn($item) => $item['id'] === $product->id && $item['supplier_id'] === $supplier->id);

            if ($index !== false) {
                $this->cart[$index]['quantity'] += 1;
            } else {
                $this->cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'supplier_id' => $supplier->id ?? "Tidak ada supplier",
                    'supplier_name' => $supplier->name ?? "Tidak ada supplier",
                    'units' => $product->units,
                    'unit' => $unitId,
                    'unit_name' => $unitName,
                    'multiplier' => $unitMultiplier,
                ];
            }

            $this->updateGroupedCart();
        }
    }

    public function updateGroupedCart()
    {
        $this->groupedCart = collect($this->cart)->groupBy('supplier_name');
    }

    public function updateSelectedSupplier()
    {
        // Pastikan supplier dipilih
        if (!$this->selectedSupplier) {
            return; // Berhenti jika tidak ada supplier yang dipilih
        }

        $supplier = Supplier::find($this->selectedSupplier);
        $product = Product::find($this->selectedProduct);

        // Cek apakah supplier sudah terhubung
        if (!$product->suppliers->contains($supplier->id)) {
            $product->suppliers()->attach($supplier->id);
        }

        // Tambahkan ke cart
        $this->addToCart($this->selectedProduct);

        // Reset data dan tutup modal
        $this->reset(['selectedProduct', 'selectedSupplier']);
        $this->closeModal();
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

    #[On('closeModal')]
    public function closeModal()
    {
        $this->modalSupplier = false;
    }
}
