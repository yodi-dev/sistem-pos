<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Milon\Barcode\DNS1D;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Halaman Produk | Yudis')]
class ProductManager extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $Product;
    public $productId;

    public $isBarcodeModalOpen = false;
    public $barcodeImage;
    public $barcodeQuantity = 1;

    private function generateUniqueCode()
    {
        do {
            // Generate angka acak sepanjang 13 digit
            $code = (string) mt_rand(1000000000000, 9999999999999);
        } while (Product::where('code', $code)->exists()); // Cek apakah kode sudah ada di database

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

    public function barcode($productId)
    {
        $this->Product = Product::find($productId);

        if ($this->Product) {
            // Jika produk tidak memiliki kode, buat kode baru
            if (empty($this->Product->code)) {
                $this->Product->code = $this->generateUniqueCode();
                $this->Product->save(); // Simpan kode baru ke database
            }

            // Generate gambar barcode dari kode produk
            $this->barcodeImage = $this->generateBarcodeImage($this->Product->code);
        }

        $this->isBarcodeModalOpen = true;
    }

    public function render()
    {
        $products = Product::with('units')->where('name', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.product.index', compact('products'));
    }

    public function showDetails($productId)
    {
        $this->Product = Product::with('category')->find($productId);
        $this->isModalOpen = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isModalOpen = false;
        $this->isModalSatuan = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->category_id = '';
        $this->price = '';
        $this->stock = '';
        $this->description = '';
        $this->product_id = '';
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully.');
    }
}
