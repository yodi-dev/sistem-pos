<?php

namespace App\Livewire\Product;

use App\Helpers\Format;
use App\Models\Product;
use Livewire\Component;
use App\Models\Supplier;
use Milon\Barcode\DNS1D;

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
        $this->formatData();

        $this->selectedSupplier = session()->get('selectedSupplier', '');
        $this->selectedSupplier ? $this->searchSupplier = $this->selectedSupplier->name : '';
    }

    private function formatData()
    {
        if ($this->cart) {
            foreach ($this->cart as &$item) {
                $item['purchase_price'] = Format::rupiah($item['purchase_price']);
                $item['retail_price'] = Format::rupiah($item['retail_price']);
                $item['wholesale_price'] = Format::rupiah($item['wholesale_price']);
            }
        }
    }

    public function removeFromCart($id)
    {
        $this->cart = session()->get('cartUpdate', []);
        $index = collect($this->cart)->search(fn($item) => $item['id'] === $id);

        if ($index !== false) {
            unset($this->cart[$index]);
            $this->cart = array_values($this->cart);
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
        // $this->resetSearch();
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
        $this->cart[$key]['purchase_price'] = str_replace('.', '', $this->cart[$key]['purchase_price']);
    }

    public function updateCartStock($key, $value)
    {
        $this->filterData($key);

        $this->cart[$key]['stock'] = (int) $value;
        $this->cart[$key]['amount'] = $this->cart[$key]['stock'] * $this->cart[$key]['purchase_price'];

        $this->formatData();

    }

    // public function updatePurchase($index, $purchase_price)
    // {
    //     $this->cart[$index]['purchase_price'] = str_replace('.', '', $purchase_price);
    // }

    // public function updateRetail($index, $retail_price)
    // {
    //     $this->cart[$index]['retail_price'] = str_replace('.', '', $retail_price);
    // }
    
    // public function updateWholesale($index, $wholesale_price)
    // {
    //     $this->cart[$index]['wholesale_price'] = str_replace('.', '', $wholesale_price);
    // }


    public function togglePrintBarcode($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['print_barcode'] = !$this->cart[$productId]['print_barcode'];
        }
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (!isset($this->cart[$productId])) {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'purchase_price' => $product->purchase_price,
                'retail_price' => $product->retail_price,
                'wholesale_price' => $product->wholesale_price,
                'stock' => 0,
                'amount' => 0,
                // 'print_barcode' => false,
            ];
        }

        session()->put('cartUpdate', $this->cart);
        $this->resetSearch();
    }

    // public function save()
    // {
    //     $generator = new DNS1D();
    //     $barcodesData = [];
    //     $zip = new \ZipArchive();
    //     $zipFileName = storage_path('app/public/barcodes.zip');
    //     $barcodeGenerated = false;

    //     // Buat ZIP baru
    //     if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
    //         session()->flash('error', 'Gagal membuat file ZIP.');
    //         return;
    //     }

    //     foreach ($this->cart as $item) {
    //         // Ambil data produk hanya sekali
    //         $product = Product::find($item['id']);

    //         $product->stock += $item['stock'];
    //         $product->purchase_price = $item['purchase_price'];
    //         $product->retail_price = $item['retail_price'];
    //         $product->wholesale_price = $item['wholesale_price'];
    //         $product->save();

    //         // Proses cetak barcode jika "print_barcode"
    //         if ($item['print_barcode']) {
    //             $barcodes = [];
    //             $barcodeGenerated = true;

    //             // Pastikan $product->code tidak kosong
    //             if (empty($product->code)) {
    //                 // Berikan pesan error atau abaikan produk
    //                 return session()->flash('error', 'Gagal mencetak barcode, kode produk belum ada.');
    //             }

    //             // Generate barcode sebanyak stok
    //             for ($i = 0; $i < $item['stock']; $i++) {
    //                 $barcodes[] = $generator->getBarcodePNG($product->code, 'C39', 3, 33);
    //             }

    //             // Buat file PDF untuk produk
    //             $pdf = \PDF::loadView('livewire.barcode.print', [
    //                 'product' => $product,
    //                 'barcodes' => $barcodes,
    //             ])->setPaper([0, 0, 226, 567], 'portrait'); // Kertas 58mm x panjang dinamis

    //             // Simpan PDF ke storage sementara
    //             $pdfFilePath = storage_path("app/public/{$product->name}_barcode.pdf");
    //             file_put_contents($pdfFilePath, $pdf->output());

    //             // Tambahkan file PDF ke ZIP
    //             $zip->addFile($pdfFilePath, "{$product->code}_barcode.pdf");

    //             // Simpan data barcode untuk log/debugging jika diperlukan
    //             $barcodesData[$product->code] = $barcodes;
    //         }
    //     }

    //     // Tutup ZIP setelah semua file ditambahkan
    //     $zip->close();

    //     session()->forget('cartUpdate');

    //     // Bersihkan keranjang dan berikan feedback
    //     $this->cart = [];
    //     session()->flash('success', 'Data berhasil diperbarui.');

    //     // Unduh file ZIP
    //     if ($barcodeGenerated) {
    //         return response()->download($zipFileName)->deleteFileAfterSend();
    //     }
    // }
}
