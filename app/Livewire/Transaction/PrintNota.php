<?php

namespace App\Livewire\Transaction;

use Livewire\Component;

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
}
