<?php

namespace App\Livewire\Wholesale;

use App\Models\Unit;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Wholesale;
use Livewire\Attributes\On;
use App\Models\WholesaleItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class WholesaleManager extends Component
{
    public $wholesales;
    public $selectedWholesale;
    public $showDetailModal = false;
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
        $this->wholesales = Wholesale::with('supplier', 'wholesaleItems')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($wholesale) {
                $totalBarang = $wholesale->wholesaleItems->sum('quantity');
                $wholesale->total_barang = $totalBarang;
                return $wholesale;
            });

        $products = Product::query();

        if ($this->minimum) {
            $products->where('stock', '<=', $this->minimum);
        }
        if ($this->category) {
            $products->whereHas('category', function ($query) {
                $query->where('name', $this->category);
            });
        }
        if ($this->supplier) {
            $products->whereHas('suppliers', function ($query) {
                $query->where('name', $this->supplier);
            });
        }

        $products = $products->orderBy('id', 'desc');
        $products = $products->paginate(20);

        return view(
            'livewire.wholesale.wholesale-manager',
            compact('products')
        );
    }

    public function mount()
    {
        $this->cart = session()->get('cartWholesale', []);
        $this->updateGroupedCart();

        $this->categories = Category::all();
        $this->suppliers = Supplier::all();
    }

    public function show($id)
    {
        $this->selectedWholesale = Wholesale::with('supplier', 'wholesaleItems.product')->find($id);
        $this->showDetailModal = true;
    }

    public function printWholesale($id)
    {
        return redirect()->route('wholesale.print', $id);
    }

    public function print($id)
    {
        $selectedWholesale = Wholesale::with(['supplier', 'wholesaleItems.product'])->findOrFail($id);

        $data = [
            'selectedWholesale' => $selectedWholesale,
        ];

        $pdf = Pdf::loadView('wholesale.print', $data);

        return $pdf->download('detail_kulakan.pdf');
    }


    public function delete($id)
    {
        Wholesale::find($id)->delete();
        $this->dispatch('showToast', 'Berhasil menghapus data kulakan.');
    }

    public function selectProduct($productId)
    {
        $product = Product::with('suppliers')->find($productId);

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
            $supplier = $this->selectedSupplier ? Supplier::find($this->selectedSupplier) : $product->suppliers->first();

            if ($unit) {
                $unitId = $unit->id;
                $unitName = $unit->name;
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
                    'unit_id' => $unitId ?? '',
                    'unit_name' => $unitName ?? '',
                ];
            }

            session()->put('cartWholesale', $this->cart);
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
        $index = collect($this->cart)->search(fn($item) => $item['id'] === $id);

        if ($index !== false) {
            unset($this->cart[$index]);
            $this->cart = array_values($this->cart);
            session()->put('cartWholesale', $this->cart);
        }

        if (empty($this->cart)) {
            $this->dispatch('close-modal');
        }

        $this->updateGroupedCart();
    }

    public function store()
    {
        DB::beginTransaction();

        try {
            $unitIds = collect($this->groupedCart)->flatten(1)->pluck('unit_id')->unique();
            $units = Unit::whereIn('id', $unitIds)->pluck('name', 'id');

            foreach ($this->groupedCart as $supplierName => $items) {
                $supplierId = Supplier::where('name', $supplierName)->value('id');
                if (!$supplierId) {
                    throw new \Exception("Supplier $supplierName tidak ditemukan.");
                }

                // Cek apakah sudah ada wholesale untuk supplier ini pada hari yang sama
                $wholesale = Wholesale::where('supplier_id', $supplierId)
                    ->whereDate('date', today())
                    ->first();

                // Jika tidak ada, buat wholesale baru
                if (!$wholesale) {
                    $wholesale = Wholesale::create([
                        'supplier_id' => $supplierId,
                        'date' => now(),
                    ]);
                }

                foreach ($items as $item) {
                    $existingItem = WholesaleItem::where('wholesale_id', $wholesale->id)
                        ->where('product_id', $item['id'])
                        ->first();

                    if ($existingItem) {
                        // Jika produk sudah ada, update quantity
                        $existingItem->increment('quantity', $item['quantity']);
                    } else {
                        // Jika produk belum ada, tambahkan sebagai item baru
                        WholesaleItem::create([
                            'wholesale_id' => $wholesale->id,
                            'product_id' => $item['id'],
                            'quantity' => $item['quantity'],
                            'unit' => $units[$item['unit_id']] ?? '',
                        ]);
                    }
                }
            }

            DB::commit();
            $this->resetCart();
            session()->forget('cartWholesale');
            $this->dispatch('showToast', 'Berhasil menyimpan data kulakan.');
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
        $this->showDetailModal = false;
    }
}
