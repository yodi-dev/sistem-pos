<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Milon\Barcode\DNS1D;

class UpdateStok extends Component
{
    public $search = '';
    public $products = [];
    public $cart = [];

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

    public function updateCartStock($productId, $stock)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['stock'] = max(0, (int)$stock);
        }
    }

    public function updateCartPurchase($productId, $purchase_price)
    {
        $purchase_price = str_replace('.', '', $purchase_price);
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['purchase_price'] = $purchase_price;
        }
    }

    public function updateCartRetail($productId, $retail_price)
    {
        $retail_price = str_replace('.', '', $retail_price);
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['retail_price'] = $retail_price;
        }
    }

    public function updateCartWholesale($productId, $wholesale_price)
    {
        $wholesale_price = str_replace('.', '', $wholesale_price);
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['wholesale_price'] = $wholesale_price;
        }
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

        if (!isset($this->cart[$productId])) {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'purchase_price' => $product->purchase_price,
                'retail_price' => $product->retail_price,
                'wholesale_price' => $product->wholesale_price,
                'stock' => 0,
                'checked' => false,
                'print_barcode' => false,
            ];
        }
        $this->resetSearch();
    }

    public function save()
    {
        $generator = new DNS1D();
        $barcodesData = [];
        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/public/barcodes.zip');
        $barcodeGenerated = false;

        // Buat ZIP baru
        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            session()->flash('error', 'Gagal membuat file ZIP.');
            return;
        }

        foreach ($this->cart as $item) {
            // Ambil data produk hanya sekali
            $product = Product::find($item['id']);

            $product->stock += $item['stock'];
            $product->purchase_price = $item['purchase_price'];
            $product->retail_price = $item['retail_price'];
            $product->wholesale_price = $item['wholesale_price'];
            $product->save();

            // Proses cetak barcode jika "print_barcode"
            if ($item['print_barcode']) {
                $barcodes = [];
                $barcodeGenerated = true;

                // Pastikan $product->code tidak kosong
                if (empty($product->code)) {
                    // Berikan pesan error atau abaikan produk
                    return session()->flash('error', 'Gagal mencetak barcode, kode produk belum ada.');
                }

                // Generate barcode sebanyak stok
                for ($i = 0; $i < $item['stock']; $i++) {
                    $barcodes[] = $generator->getBarcodePNG($product->code, 'C39', 3, 33);
                }

                // Buat file PDF untuk produk
                $pdf = \PDF::loadView('livewire.barcode.print', [
                    'product' => $product,
                    'barcodes' => $barcodes,
                ])->setPaper([0, 0, 226, 567], 'portrait'); // Kertas 58mm x panjang dinamis

                // Simpan PDF ke storage sementara
                $pdfFilePath = storage_path("app/public/{$product->name}_barcode.pdf");
                file_put_contents($pdfFilePath, $pdf->output());

                // Tambahkan file PDF ke ZIP
                $zip->addFile($pdfFilePath, "{$product->code}_barcode.pdf");

                // Simpan data barcode untuk log/debugging jika diperlukan
                $barcodesData[$product->code] = $barcodes;
            }
        }

        // Tutup ZIP setelah semua file ditambahkan
        $zip->close();

        // Bersihkan keranjang dan berikan feedback
        $this->cart = [];
        session()->flash('success', 'Data berhasil diperbarui.');

        // Unduh file ZIP
        if ($barcodeGenerated) {
            return response()->download($zipFileName)->deleteFileAfterSend();
        }
    }

    public function render()
    {
        return view('livewire.product.update-stok', [
            'products' => $this->products,
        ]);
    }
}
