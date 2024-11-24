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
        $this->products = Product::where('name', 'like', "%{$this->search}%")->get();

        if (empty($this->search)) {
            $this->products = [];
        }
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (!isset($this->cart[$productId])) {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'stock' => 1,
                'checked' => false,
                'print_barcode' => false,
            ];
        }
        $this->resetSearch();
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

    public function toggleChecked($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['checked'] = !$this->cart[$productId]['checked'];
        }
    }

    public function togglePrintBarcode($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['print_barcode'] = !$this->cart[$productId]['print_barcode'];
        }
    }

    public function save()
    {
        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/public/barcodes.zip');

        // Buat ZIP baru
        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            session()->flash('error', 'Gagal membuat file ZIP.');
            return;
        }

        $generator = new DNS1D();

        foreach ($this->cart as $item) {
            if ($item['checked']) {
                $product = Product::find($item['id']);
                $product->stock += $item['stock'];
                $product->save();
            }

            if ($item['print_barcode']) {
                $product = Product::find($item['id']);
                $barcodes = [];

                for ($i = 0; $i < $item['stock']; $i++) {
                    $barcodes[] = $generator->getBarcodePNG($product->code, 'C39', 3, 33);
                }

                $pdf = \PDF::loadView('livewire.barcode.print', [
                    'product' => $product,
                    'barcodes' => $barcodes,
                ])->setPaper([0, 0, 226, 567], 'portrait'); // Kertas 58mm x panjang dinamis

                $pdfFilePath = storage_path("app/public/{$product->name}_barcode.pdf");
                file_put_contents($pdfFilePath, $pdf->output());

                // Tambahkan file PDF ke dalam ZIP
                $zip->addFile($pdfFilePath, "{$product->name}_barcode.pdf");
            }
        }

        session()->flash('success', 'Proses selesai.');
        $this->cart = [];

        // Tutup ZIP dan bersihkan file PDF sementara
        $zip->close();

        // Unduh file ZIP
        return response()->download($zipFileName)->deleteFileAfterSend();
    }

    public function render()
    {
        return view('livewire.product.update-stok', [
            'products' => $this->products,
        ]);
    }
}
