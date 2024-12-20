<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Component;

class Dashboard extends Component
{
    public $minimum = 0;

    public function render()
    {
        $products = Product::where('stock', '<=', $this->minimum)->paginate(50);
        return view('livewire.dashboard.dashboard', compact('products'));
    }

    public function mount()
    {
        // $minimum = 0;
        // $this->products = Product::where('stock', '<=', $minimum)->paginate(50);
    }
}
