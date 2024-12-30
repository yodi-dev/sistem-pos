<?php

namespace App\Livewire\Wholesale;

use App\Models\Wholesale;
use Livewire\Component;

class WholesaleManager extends Component
{
    public $wholesales;

    public function render()
    {
        return view('livewire.wholesale.wholesale-manager');
    }

    public function mount()
    {
        $this->wholesales = Wholesale::with('supplier')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
