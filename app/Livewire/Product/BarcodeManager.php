<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Milon\Barcode\DNS1D;


class BarcodeManager extends Component
{
    public $product;

    public $barcodeImage;
    public $barcodeQuantity = 1;

    public function render()
    {
        return view('livewire.product.barcode-manager');
    }

    public function mount($id)
    {
        $this->product = Product::find($id);

        if ($this->product) {
            // Jika produk tidak memiliki kode, buat kode baru
            if (empty($this->product->code)) {
                $this->product->code = $this->generateUniqueCode();
                $this->product->save(); // Simpan kode baru ke database
            }

            // Generate gambar barcode dari kode produk
            $this->barcodeImage = $this->generateBarcodeImage($this->product->code);
        }
    }

    private function generateUniqueCode()
    {
        do {
            $code = (string) mt_rand(1000000000000, 9999999999999);
        } while (Product::where('code', $code)->exists());

        return $code;
    }

    public function printBarcode($productId)
    {
        $product = Product::findOrFail($productId);
        $barcodes = [];
        $generator = new DNS1D();


        for ($i = 0; $i < $this->barcodeQuantity; $i++) {
            $barcodes[] = $generator->getBarcodePNG($product->code, 'C39', 3, 33);
        }

        $pdf = \PDF::loadView('livewire.barcode.print', [
            'product' => $product,
            'barcodes' => $barcodes,
        ])->setPaper([0, 0, 226, 567], 'portrait'); // Kertas 58mm x panjang dinamis

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "barcode_{$product->name}.pdf");
    }

    private function generateBarcodeImage($code)
    {
        $generator = new DNS1D();
        $barcodeData = $generator->getBarcodePNG($code, 'C39', 3, 33);
        return 'data:image/png;base64,' . $barcodeData;
    }
}
