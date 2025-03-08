<?php

namespace App\Livewire\Product;

use App\Helpers\Format;
use App\Models\Product;
use App\Models\StockIn;
use Livewire\Component;
use App\Models\Supplier;
use Milon\Barcode\DNS1D;
use Livewire\Attributes\On;
use App\Models\StockInDetail;
use Illuminate\Support\Facades\DB;

class UpdateStok extends Component
{
    public $search = '';
    public $searchSupplier;
    public $supplier;
    public $selectedSupplier;
    public $products = [];
    public $suppliers = [];
    public $cart = [];
    public $highlightIndex = 0;

    public function render()
    {
        return view('livewire.product.update-stok', [
            'products' => $this->products,
        ]);
    }

    public function mount()
    {
        $this->cart = session()->get('cartUpdate', []);
        $this->selectedSupplier = session()->get('selectedSupplier', '');
        $this->supplier = $this->selectedSupplier;
        $this->selectedSupplier ? $this->searchSupplier = $this->selectedSupplier->name : '';
    }

    public function removeFromCart($id)
    {
        $this->cart = session()->get('cartUpdate', []);
        $index = collect($this->cart)->search(fn($item) => $item['id'] === $id);

        if ($index !== false) {
            unset($this->cart[$index]);
            $this->cart = array_values($this->cart);

            // $this->formatData();
            session()->put('cartUpdate', $this->cart);
            $this->dispatch('showToast', 'Berhasil menghapus item.');
        }
    }

    public function updatedSearchSupplier()
    {
        $this->suppliers = Supplier::where('name', 'like', '%' . $this->searchSupplier . '%')->get();

        if (empty($this->searchSupplier)) {
            $this->suppliers = [];
        }
    }

    public function selectNextSupplier()
    {
        if ($this->highlightIndex < count($this->suppliers) - 1) {
            $this->highlightIndex++;
        }
    }

    public function confirmSupplier()
    {
        if (!empty($this->suppliers)) {
            $selectedSupplier = $this->suppliers[$this->highlightIndex];
            $this->addSupplier($selectedSupplier->id);
            $this->highlightIndex = 0;
        }
    }

    public function addSupplier($supplierId)
    {
        $supplier = Supplier::find($supplierId);

        if ($supplier) {
            $this->supplier = $supplier;
            $this->selectedSupplier = $supplier;
            $this->searchSupplier = $supplier->name;
            session()->put('selectedSupplier', $supplier);
        }

        $this->resetErrorBag('supplier');
    }

    public function updatedSearch()
    {
        $this->products = Product::where('name', 'like', "%{$this->search}%")
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->get();

        if (empty($this->search)) {
            $this->products = [];
        }
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->products = [];
    }

    public function selectNext()
    {
        if ($this->highlightIndex < count($this->products) - 1) {
            $this->highlightIndex++;
        }
    }

    public function selectPrevious()
    {
        if ($this->highlightIndex > 0) {
            $this->highlightIndex--;
        }
    }

    public function confirmSelection()
    {
        if (!empty($this->products) && isset($this->products[$this->highlightIndex])) {
            $this->addToCart($this->products[$this->highlightIndex]['id']);
        }
    }

    private function filterData($key)
    {
        $this->cart[$key]['purchase_price'] = str_replace('.', '', $this->cart[$key]['purchase_price']);
        $this->cart[$key]['retail_price'] = str_replace('.', '', $this->cart[$key]['retail_price']);
        $this->cart[$key]['wholesale_price'] = str_replace('.', '', $this->cart[$key]['wholesale_price']);
    }

    public function updateHarga($index)
    {
        $this->cart[$index]['amount'] = $this->cart[$index]['purchase_price'] * $this->cart[$index]['qty'];
    }

    public function updateTotal($index, $value)
    {

        $value = str_replace('.', '', $value);
        $this->cart[$index]['purchase_price'] = Format::rupiah($value);
        $this->cart[$index]['amount'] = Format::rupiah($value * $this->cart[$index]['stock']);

        session()->put('cartUpdate', $this->cart);
    }

    public function updateCartStock($key, $value)
    {
        $this->filterData($key);

        $this->cart[$key]['stock'] = (int) $value;
        $this->cart[$key]['amount'] = Format::rupiah($this->cart[$key]['stock'] * $this->cart[$key]['purchase_price']);

        $this->cart[$key]['purchase_price'] = Format::rupiah($this->cart[$key]['purchase_price']);
        $this->cart[$key]['retail_price'] = Format::rupiah($this->cart[$key]['retail_price']);

        session()->put('cartUpdate', $this->cart);
    }

    public function togglePrintBarcode($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['print_barcode'] = !$this->cart[$productId]['print_barcode'];
        }
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        $index = collect($this->cart)->search(fn($item) => $item['id'] === $product->id);

        if ($index !== false) {
            $this->cart[$index]['stock'] += 1;
        } else {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'purchase_price' => Format::rupiah($product->purchase_price),
                'retail_price' => Format::rupiah($product->retail_price),
                'wholesale_price' => Format::rupiah($product->wholesale_price),
                'stock' => 1,
                'amount' => Format::rupiah(1 * $product->purchase_price),
            ];
        }

        session()->put('cartUpdate', $this->cart);
        $this->resetSearch();
    }

    public function save()
    {
        $this->validate([
            'supplier' => 'required',
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.stock' => 'required|integer|min:1',
            'cart.*.purchase_price' => 'required|numeric|min:0',
            'cart.*.retail_price' => 'required|numeric|min:0',
            'cart.*.wholesale_price' => 'required|numeric|min:0',
        ], [
            'supplier.required' => 'Supplier harus dipilih.',
        ]);

        DB::transaction(function () {
            $stockIn = StockIn::create([
                'supplier_id' => $this->supplier->id,
                'date' => now(),
            ]);

            foreach ($this->cart as $item) {
                $purchase_price = (int) str_replace(['.', ','], '', $item['purchase_price']);
                $retail_price = (int) str_replace(['.', ','], '', $item['retail_price']);
                $wholesale_price = (int) str_replace(['.', ','], '', $item['wholesale_price']);

                StockInDetail::create([
                    'stock_in_id' => $stockIn->id,
                    'product_id' => $item['id'],
                    'purchase_price' => $purchase_price,
                    'quantity' => $item['stock'],
                    'total_price' => $item['amount'],
                ]);

                Product::where('id', $item['id'])->update([
                    'stock' => DB::raw("stock + {$item['stock']}"),
                    'purchase_price' => $purchase_price,
                    'retail_price' => $retail_price,
                    'wholesale_price' => $wholesale_price,
                ]);
            }
        });

        $this->cart = [];
        $this->supplier = null;
        $this->searchSupplier = '';
        $this->suppliers = [];
        session()->forget('cartUpdate');
        session()->forget('selectedSupplier');

        $this->dispatch('showToast', 'Berhasil menyimpan data.');
    }
}
