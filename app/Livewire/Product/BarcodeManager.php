<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Milon\Barcode\DNS1D;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


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
        // Ambil data produk
        $product = Product::findOrFail($productId);

        // Cek jumlah barcode yang akan dicetak
        $barcodeQuantity = $this->barcodeQuantity ?? 1;

        try {
            // Hubungkan ke printer (ganti "Nama_Printer" sesuai dengan printer thermal Anda)
            $connector = new WindowsPrintConnector("thermal");
            $printer = new Printer($connector);


            // Loop untuk mencetak beberapa barcode
            for ($i = 0; $i < $barcodeQuantity; $i++) {
                // Header (opsional)
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->setTextSize(1, 1); // Ukuran teks normal
                $printer->text($product->name . "\n"); // Nama produk

                // Barcode
                $printer->setBarcodeHeight(70); // Tinggi barcode (disesuaikan)
                $printer->setBarcodeWidth(1);  // Ketebalan garis barcode
                $printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
                $printer->barcode($product->code, Printer::BARCODE_CODE93);

                // Jarak antar label
                // $printer->feed(4);
            }

            // Potong kertas
            $printer->cut();

            // Tutup koneksi printer
            $printer->close();

            return response()->json(['success' => true, 'message' => 'Barcode berhasil dicetak.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    private function generateBarcodeImage($code)
    {
        $generator = new DNS1D();
        $barcodeData = $generator->getBarcodePNG($code, 'C39', 3, 33);
        return 'data:image/png;base64,' . $barcodeData;
    }
}
