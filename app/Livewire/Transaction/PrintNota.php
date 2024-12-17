<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class PrintNota extends Component
{
    public $cart = [];
    public $total = 0;

    public function render()
    {
        return view('livewire.transaction.print-nota')->layout('layouts.print');
    }

    public function mount()
    {
        $this->cart = session('cart', []);
        $this->total = session('total', 0);
    }

    public function printNota()
    {
        $connector = new FilePrintConnector("smb://server/printer-name");
        $printer = new Printer($connector);

        // header
        $printer->setStyles(['align' => 'center']);
        $printer->text("Habiba Store \n");
        $printer->text("Alamat: jalan kh a \n");
        $printer->feed(2);

        // items
        foreach ($this->cart as $item) {
            $printer->text($item['name'] . " - " . $item['quantity'] . " X " . number_format($item['price'], 0, ',', '.') . "\n");
        }
        $printer->feed(2);

        // total
        $printer->text("total: " . number_format($this->total, 0, ',', '.'));

        $printer->cut();
        $printer->close();
    }
}
