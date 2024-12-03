<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Category;

class CreateProduct extends Component
{
    public $categories;

    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.product.create-product');
    }
}
