<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Wholesale;
use Livewire\Attributes\On;
use App\Models\WholesaleItem;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $minimum = 1;
    public $cart = [];
    public $groupedCart = [];
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

        $products = $products->orderBy('id', 'desc');
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
                $unitMultiplier = 1;
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
                    'unit_id' => $unitId,
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

    public function updateCartQuantity($supplier, $index, $quantity)
    {
        $this->groupedCart[$supplier][$index]['quantity'] = $quantity;
        $this->updateGroupedCart();
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

    public function removeFromCart($id)
    {
        // $this->cart = session()->get('cart', []);
        $index = collect($this->cart)->search(fn($item) => $item['id'] === $id);

        // dd($id);
        if ($index !== false) {
            unset($this->cart[$index]);
            $this->cart = array_values($this->cart);
            // session()->put('cart', $this->cart);
        }

        if (empty($this->cart)) {
            $this->dispatch('close-modal');
        }

        // Perbarui groupedCart
        $this->updateGroupedCart();
    }

    public function store()
    {
        DB::beginTransaction();

        try {
            foreach ($this->groupedCart as $supplierName => $items) {
                // dd($items);

                $supplier = Supplier::where('name', $supplierName)->first();

                if (!$supplier) {
                    throw new \Exception("Supplier $supplierName tidak ditemukan.");
                }

                $supplierId = $supplier->id;
                // Simpan wholesale
                $wholesale = Wholesale::create([
                    'supplier_id' => $supplierId,
                    'date' => now(),
                ]);


                $itemsData = [];
                foreach ($items as $item) {
                    $unit = Unit::where('id', $item['unit_id'])->first();

                    $itemsData[] = [
                        'wholesale_id' => $wholesale->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'unit' => $unit->name,
                        'total_stock' => $item['quantity'] * $item['multiplier'], // Hitung stok total
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    // Update stok produk
                    $product = Product::find($item['id']);
                    if ($product) {
                        // Misalkan stok diupdate berdasarkan total_stock dari wholesale item
                        $product->stock += $item['quantity'] * $item['multiplier']; // Update stok produk
                        $product->save();
                    }
                }
                WholesaleItem::insert($itemsData);
            }

            DB::commit();
            $this->resetCart();
            session()->flash('message', 'Berhasil menyimpan data kulakan.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function resetCart()
    {
        $this->cart = [];
        $this->groupedCart = [];
        $this->dispatch('close-modal');
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->modalSupplier = false;
    }
}
