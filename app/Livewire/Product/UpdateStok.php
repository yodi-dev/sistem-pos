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
        $downloadUrls = []; // Untuk menyimpan URL file yang akan diunduh

        foreach ($this->cart as $item) {
            if ($item['checked']) {
                $product = Product::find($item['id']);
                $product->stock += $item['stock'];
                $product->save();
            }

            if ($item['print_barcode']) {
                $product = Product::find($item['id']);
                $downloadUrls[] = $this->printBarcode($product->id, $item['stock']);
            }
        }

        session()->flash('success', 'Stok Berhasil Diperbarui.');
        $this->cart = [];

        // Jika ada file yang harus diunduh, redirect ke file pertama
        if (!empty($downloadUrls)) {
            return redirect($downloadUrls[0]); // Unduh file pertama
        }

        return redirect()->route('products'); // Jika tidak ada file, kembali ke halaman produk
    }


    public function printBarcode($productId, $quantity)
    {
        $product = Product::findOrFail($productId);
        $barcodes = [];
        $generator = new DNS1D();

        for ($i = 0; $i < $quantity; $i++) {
            $barcodes[] = $generator->getBarcodePNG($product->code, 'C39', 3, 33);
        }

        $pdf = \PDF::loadView('livewire.barcode.print', [
            'product' => $product,
            'barcodes' => $barcodes,
        ])->setPaper([0, 0, 226, 567], 'portrait'); // Kertas 58mm x panjang dinamis

        // Pastikan direktori `storage/app/temp` tersedia
        $tempPath = storage_path('app/temp');
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0755, true); // Buat folder jika belum ada
        }

        // Simpan file PDF
        $fileName = "barcode_{$product->name}.pdf";
        $filePath = $tempPath . "/{$fileName}";
        \File::put($filePath, $pdf->output());

        // Kembalikan URL file untuk diunduh
        return asset("storage/temp/{$fileName}");
    }


    public function render()
    {
        return view('livewire.product.update-stok', [
            'products' => $this->products,
        ]);
    }
}
