<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class BarcodePrint extends Component
{
    public $products = [];
    public $selectedProducts = [];
    public $barcodeCount = 1;
    public $barcodeSize = 'medium';

    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.barcode.index')->layout('layouts.app');
    }

    public function printBarcodes()
    {
        // Logika cetak barcode
    }
}
